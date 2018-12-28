<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    public function getMenu()
    {
        $permissionService = new PermissionService;

        $id = 1;
        // 根据用户id查询角色id组
        $roleIds = $permissionService->getRoleIdsByUserId($id);

        $data = $permissionService->getPermissionByRoleIds($roleIds);
        // 生成树结构
        $tree = $permissionService->makeTree($data);

        return $tree;
    }

    public function getRoleList()
    {
        // $permissionService = new PermissionService;

        // $list = $permissionService->getRoleList();

        // return $list;
        $permissionService = new PermissionService;

        $id = 1;
        // 根据用户id查询角色id组
        $roleIds = $permissionService->getRoleIdsByUserId($id);

        $data = $permissionService->getPermissionByRoleIds($roleIds);

        $tree = $permissionService->getTree($data);
        
        return $tree;
    }

    public function getUserList()
    {
        $permissionService = new PermissionService;

        $list = $permissionService->getUserList();

        return $list;
    }

    public function getPermissionList()
    {
        $permissionService = new PermissionService;
        
        $list = $permissionService->getPermissionList();

        return $list;

    }

    public function allotPermission(Request $request)
    {
        $json = $request->post('json');
    }

    public function editPermission(Request $request)
    {
        $permissionService = new PermissionService;
        
        $id = 1;

        $data = $permissionService->getPermissionById($id);
        dd($data);
    }
}
