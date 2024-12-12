<?php

namespace App\Services;

use App\Models\Admin;
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

        $separate = explode('.', $sub_module_code_operate);
        $sub_module_code = $separate[0];
        $type = $separate[1];


        $super_admin_email = getenv('SUPER_ADMIN_EMAIL');
        if (Auth::user()->email == $super_admin_email) {
            return true;
            //abort(403, 'You do not have permission to access this action.');
        }
        $admin = Auth::user();
        $adminRoles = AdminRole::where('admin_id', $admin->id)->get();
        $subModuleId = SubModule::where('sub_module_code', $sub_module_code)->first()->id;

        $permission = Permission::where('role_id', $adminRoles->role_id)->where('sub_module_id', $subModuleId)->where('type', $type)->first();

        if ($permission) {
            return true;
        } else {
            abort(403, 'You do not have permission to access this action.');
        }

    }
}
