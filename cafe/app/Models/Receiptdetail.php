<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
class Receiptdetail extends Model
{
    use HasFactory;
    protected $table = 'receiptdetail';
    protected $primaryKey = 'DetaiId';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'DetaiId',
        'Idreceipt',
        'IdProduct',
        'Quantity',
        'Unit',
        'Price',
    ];


     public function getproAttribute(){
      $id=$this->IdProduct;
      $us=Products::where('IdProduct','=',$id)->first();
      return $us->NameProduct;
    }

    public function getunitAttribute(){
      $id=$this->IdProduct;
      $us=Products::where('IdProduct','=',$id)->first();
      return $us->Unit;
    }
}
