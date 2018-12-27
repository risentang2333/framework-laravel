<?php

namespace App\Services;

use App\Entities\Users;
use App\Entities\RoleUser;
use App\Entities\Roles;
use App\Entities\PermissionRole;
use App\Entities\Permissions;



class PermissionService 
{
    private $roleUserData = [
        'role_user.id',
        'role_user.user_id',
        'role_user.role_id',
        'users.name as user_name',
        'roles.name as role_name',
    ];

    private $permissionRoleData = [
        'id',
        'route',
        'name',
        'description',
        'icon',
        'sort_order',
        'parent_id',
        'is_display',
    ];

    public function getRoleUser()
    {
        $data = RoleUser::leftjoin('users', function ($join) {
            $join->on('user_id','users.id');
        })->rightjoin('roles', function ($join) {
            $join->on('role_id','roles.id');
        })->select($this->roleUserData)->get()->toArray();
    
        return $data;
    }

    public function getPermissionRole()
    {
        $data = PermissionRole::leftjoin('permissions', function ($join) {
            $join->on('permission_id','permissions.id');
        })->rightjoin('roles', function ($join) {
            $join->on('role_id','roles.id');
        })->select($this->permissionRoleData)->get()->toArray();

        return $data;
    }

    public function getRoleIdsByUserId($id)
    {
        $data = RoleUser::where('user_id',$id)->pluck('role_id')->toArray();
        
        return $data;
    }

    public function getPermissionByRoleIds($roleIds)
    {
        $permissionIds = PermissionRole::whereIn('role_id',$roleIds)->pluck('permission_id')->toArray();

        $data = Permissions::select($this->permissionRoleData)->whereIn('id',$permissionIds)->get()->keyBy('id')->toArray();

        return $data;
    }

    public function getTree($items)
    {
        $tree = array();
        foreach($items as $item){
            if(isset($items[$item['parent_id']])){
                $items[$item['parent_id']]['son'][] = &$items[$item['id']];
            }else{
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }
}
