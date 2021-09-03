<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslips extends Model
{
    use HasFactory;
    protected $table = 'payslips';
    protected $primaryKey = 'IdPayslip';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdPayslip',
        'UserId',
        'IdStore',
        'DatePay',
        'Note',
        'Format',
        'Image',
        'Totalprice',
    ];
}
