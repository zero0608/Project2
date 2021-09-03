<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'Idcate';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'Idcate',
        'CateName',
        'ParentId',
    ];

    
}
