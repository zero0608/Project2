<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    use HasFactory;
    protected $table = 'receipts';
    protected $primaryKey = 'IdReceipt';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdReceipt',
        'UserId',
        'IdStore',
        'DatePay',
        'Note',
        'Format',
        'Image',
        'Totalprice',
    ];

    public function getcheckAttribute(){
      if($this->Format==null){
         return "khong co";
      }else{
         return '<a href="'.route('bill.show',$this->Format).'">'.$this->Format.'</a>';
      }
    }
}
