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
        $tree = $permissionService->getTree($data);
        
        return $tree;
    }
}
