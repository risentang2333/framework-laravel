<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'users';
}