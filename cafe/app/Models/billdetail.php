<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class billdetail extends Model
{
    use HasFactory;
    protected $table = 'billdetail';
    protected $primaryKey = 'IdDetail';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdDetail',
        'IdBill',
        'IdMenu',
        'Quantity',
        'Price',
    ];
    //tìm thông tin order của  bill
    public static function findbill($idbill){
          $billdetail=billdetail::join('menus', 'billdetail.IdMenu', '=', 'menus.IdMenu')->where('IdBill',$idbill)->get();
      // $billdetail=billdetail::all();
        return $billdetail;
   }
}
