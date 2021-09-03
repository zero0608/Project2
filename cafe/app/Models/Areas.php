<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = 'IdArea';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdArea',
        'BranchName',
        'IdStore',
    ];

    public static function index()
    {
        $area=Areas::all();
        return $area;
    }


    
}
