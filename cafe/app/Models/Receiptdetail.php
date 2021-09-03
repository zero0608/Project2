<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'Quantity',
        'Unit',
        'Price',
    ];
}
