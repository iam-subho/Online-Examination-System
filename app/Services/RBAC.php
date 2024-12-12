<?php

namespace App\Services;


use App\Models\AdminRole;
use App\Models\Permission;
use App\Models\SubModule;
use Auth;

class RBAC
{
    public function __construct()
    {
    }

    public function hasPermission($sub_module_code_operate)
    {
        try {
            // Separate the sub-module code and type
            $separate = explode('.', $sub_module_code_operate);
            $sub_module_code = $separate[0] ?? null;  // Default to null if not present
            $type = $separate[1] ?? null;  // Default to null if not present

            if (!$sub_module_code || !$type) {
                abort(403, 'Invalid sub-module code or type.');
            }

            // Check if the user is the super admin
            $super_admin_email = getenv('SUPER_ADMIN_EMAIL');
            if (Auth::user()->email == $super_admin_email) {
                return true; // Super admin bypasses permission checks
            }

            // Get the logged-in admin
            $admin = Auth::user();

            if (!$admin) {
                abort(403, 'Admin not found.');
            }

            // Retrieve the admin roles
            $adminRoles = AdminRole::where('admin_id', $admin->id)->get();

            if ($adminRoles->isEmpty()) {
                abort(403, 'No roles assigned to the admin.');
            }

            // Find the submodule
            $subModule = SubModule::where('sub_module_code', $sub_module_code)->first();

            if (!$subModule) {
                abort(403, 'Submodule not found.');
            }

            // Find the permission for the given role and submodule
            $permission = Permission::where('role_id', $adminRoles->first()->role_id)
                ->where('sub_module_id', $subModule->id)
                ->where('type', $type)
                ->first();

            // If permission exists, return true
            if ($permission) {
                return true;
            } else {
                // If no permission, abort with 403
                abort(403, 'You do not have permission to access this action.');
            }

        } catch (\Exception $e) {
            \Log::error('Permission check failed: ' . $e->getMessage());
            abort(403, 'You do not have permission to access this action.');
        }
    }

}
