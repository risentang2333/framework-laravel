<?php

namespace App\Services\Api;

use App\Entities\Users;
use Illuminate\Support\Facades\DB;

class UserService 
{
    public function hasRegisterByPhone($phone)
    {
        $data = Users::where('phone', $phone)->first();

        if (empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public function register($name, $phone, $password)
    {
        // 加密后的密码
        $encryptPwd = md5('service'.$password);
        
        $user = new Users;
        $user->name = $name;
        $user->phone = $phone;
        $user->password = $encryptPwd;
        return $user->save();
    }

    public function login($phone, $password)
    {
        // 过期时间
        $expire = time() + 86400 * 3;
        // token
        $token = md5(time().$phone);
        // 加密后的密码
        $encryptPwd = md5('service'.$password);

        $user = Users::where(['phone'=>$phone, 'password'=>$encryptPwd])->first();
        if (empty($user)) {
            die('帐户名密码错误');
        } else {
            $user->expire = $expire;
            $user->token = $token;
            $user->save();
            return $user->token;
        }
    }

    public function checkToken($token)
    {
        $user = Users::select(['id','name','phone','token','icon'])->where('token', $token)->first();

        if (empty($user)) {
            die('token不存在');
        }
        if (time() > $user->expire) {
            die('token已过期');
        }
        return $user->toArray();
    }
}
