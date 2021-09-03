<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'IdCustomer';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdCustomer',
        'CustomerName',
        'PhoneNumber',
        'Email',
        'Address',
        'Note',
        'Birthday',
        'Gender',
        'Debit',
        'Avatar',
    ];


    public static function search($name){
      $search=Customers::where('IdCustomer', 'like',$name.'%')->orWhere('CustomerName', 'like','%'.$name.'%')->get();
      return $search;
    }

    public static function customall($offset){
        $cus=Customers::offset($offset)->limit(6)->get();
        return $cus;
    }
}
