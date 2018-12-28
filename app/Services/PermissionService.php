<?php

namespace App\Services;

use App\Entities\Users;
use App\Entities\RoleUser;
use App\Entities\Roles;
use App\Entities\PermissionRole;
use App\Entities\Permissions;
use Illuminate\Support\Facades\DB;



class PermissionService 
{
    private $roleUserData = [
        'role_user.id',
        'role_user.user_id',
        'role_user.role_id',
        'users.name as user_name',
        'roles.name as role_name',
    ];

    private $permissionData = [
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

    // 根据用户id查询用户绑定的角色id
    public function getRoleIdsByUserId($id)
    {
        $data = RoleUser::where('user_id',$id)->pluck('role_id')->toArray();
        
        return $data;
    }

    public function getPermissionByRoleIds($roleIds)
    {
        $permissionIds = PermissionRole::whereIn('role_id',$roleIds)->pluck('permission_id');

        $data = Permissions::select(['id','name','parent_id'])
                        ->whereIn('id',$permissionIds)
                        ->where('is_display',1)
                        ->orderBy('sort_order','ASC')
                        ->get()
                        ->keyBy('id')
                        ->toArray();
        return $data;
    }

    /**
     * 生成树结构
     *
     * @param array $items
     * @return array
     */
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

    public function makeTree($items)
    {
        $selection = array();

        foreach ($items as $key => $value) {

            if (isset($items[$value['parent_id']])) {
                $items[$key]['name'] = $items[$value['parent_id']]['name'].'>'.$items[$key]['name'];
                $items[$key]['ids'] = $items[$value['parent_id']]['id'].'-'.$items[$key]['id'];
            } else {
                $items[$key]['ids'] = $value['id'];
            }
            array_push($selection, $items[$key]);
        }
        
        return $selection;
    }

    public function getRoleList()
    {
        $data = Roles::get()->toArray();

        return $data;
    }

    public function getUserList()
    {
        $data = Users::get()->toArray();

        return $data;
    }

    public function getPermissionList()
    {
        $data = Permissions::get()->toArray();

        return $data;
    }

    public function getPermissionById($id)
    {
        $data = Permissions::find($id)->toArray();
        
        return $data;
    }
}
