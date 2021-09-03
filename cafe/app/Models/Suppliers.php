<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $primaryKey = 'IdSupplier';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdSupplier',
        'Namesupplier',
        'Email',
        'Phone',
        'Address',
        'Note',
        'Debit',
        'Avatar',
    ];


    public static function suppall($offset){
        $sup=Suppliers::offset($offset)->limit(6)->get();
        return $sup;
    }
}
