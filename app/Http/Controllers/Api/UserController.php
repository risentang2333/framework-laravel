<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\Api\UserService;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $userService = new UserService;
        // 电话号
        $phone = $request->input('phone','');
        // 密码
        $password = $request->input('password','');
        // 二次输入密码
        $rePassword = $request->input('rePassword','');
        if ($name == '') {
            return '请输入姓名';
        }
        if ($password == '') {
            return '请输入密码';
        }
        if ($rePassword == '') {
            return '请再次确认密码';
        }
        if ($password != $rePassword) {
            return '确认密码错误';
        }
        if ($userService->hasRegisterByPhone($phone)) {
            return '该电话已经被注册';
        }
        $token = $userService->register($phone, $password);

        return $token;
    }
}
