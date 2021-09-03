<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'IdArea';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdProduct',
        'NameProduct',
        'Quantity',
        'Unit',
        'Images',
        'CostPrice',
        'SallingPrice',
        'IdSupplier',
        'Idcate',
    ];
}
