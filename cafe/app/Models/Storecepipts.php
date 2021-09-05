<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
use App\Models\Suppliers;

class Storecepipts extends Model
{
    use HasFactory;
    protected $table = 'storereceipts';
    protected $primaryKey = 'Idreceipt';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'Idreceipt',
        'IdUser',
        'IdStore',
        'IdSupplier',
        'Note',
        'Paymentmethod',
        'Image',
        'Totalprice',
    ];


     public function getuserAttribute(){
      $id=$this->IdUser;
      $us=Users::find($id);
      return $us->UserName;
    }


     public function getSupplierAttribute(){
      $id=$this->IdSupplier;
      $us=Suppliers::find($id);
      return $us->Namesupplier;
    }

    
}
