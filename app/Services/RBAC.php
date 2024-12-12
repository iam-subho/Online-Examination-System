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

    public function hasPermission($sub_module_code_operate,$userAbort = true)
    {
        try {
            // Separate the sub-module code and type
            $separate = explode('.', $sub_module_code_operate);
            $sub_module_code = $separate[0] ?? null;  // Default to null if not present
            $type = $separate[1] ?? null;  // Default to null if not present

            if (!$sub_module_code || !$type) {

                if ($userAbort) {
                    abort(403, 'Invalid sub-module code or type.');
                }
                return false;
            }

            // Check if the user is the super admin
            $super_admin_email = getenv('SUPER_ADMIN_EMAIL');
            if (Auth::user()->email == $super_admin_email) {
                return true; // Super admin bypasses permission checks
            }

            // Get the logged-in admin
            $admin = Auth::user();

            if (!$admin) {
                if ($userAbort) {
                    abort(403, 'Invalid sub-module code or type.');
                }
                return false;
            }

            // Retrieve the admin roles
            $adminRoles = AdminRole::where('admin_id', $admin->id)->get();

            if ($adminRoles->isEmpty()) {
                if ($userAbort) {
                    abort(403, 'Invalid sub-module code or type.');
                }
                return false;
            }

            // Find the submodule
            $subModule = SubModule::where('sub_module_code', $sub_module_code)->first();

            if (!$subModule) {
                if ($userAbort) {
                    abort(403, 'Invalid sub-module code or type.');
                }
                return false;
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
                if ($userAbort) {
                    abort(403, 'Invalid sub-module code or type.');
                }
                return false;
            }

        } catch (\Exception $e) {
            \Log::error('Permission check failed: ' . $e->getMessage());
            if ($userAbort) {
                abort(403, 'Invalid sub-module code or type.');
            }
            return false;
        }
    }

}
