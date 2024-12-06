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

    public function hasPermission($sub_module_code,$type){

        $super_admin_email = getenv('SUPER_ADMIN_EMAIL');
        if (Auth::user()->email == $super_admin_email) {
            return true;
        }
        $admin = Auth::user();
        $adminRols = AdminRole::where('admin_id',$admin->id)->get();
        $subModuleId = SubModule::where('sub_module_code',$sub_module_code)->first()->id;

        $permission = Permission::where('role_id',$adminRols->role_id)->where('sub_module_id',$subModuleId)->where('type',$type)->first();

        if($permission){
            return true;
        }else{
            return false;
        }

    }
}
