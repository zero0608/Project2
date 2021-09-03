<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'UserId';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'UserId',
        'UserName',
        'Email',
        'IdNumber',
        'Address',
        'Phone',
        'Avatar',
        'Birthday',
        'Pass',
        'GroupId',
        'IdStore',
    ];
}
