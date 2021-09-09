<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Bills extends Model
{
    use HasFactory;
    protected $table = 'bill';
    protected $primaryKey = 'IdBill';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
    protected $fillable = [
        'IdBill',
        'IdUser',
        'IdTable',
        'IdStore',
        'IdCustomer',
        'Sale',
        'Totalprice',
        'Note',
        'StatusB',
    ];


    //
    //tìm bàn đang ngồi
    public static function findbill($idtable){
      $billon=Bills::join('customers', 'bill.IdCustomer', '=', 'customers.IdCustomer')->where('IdTable', $idtable)->where('StatusB',0)->first();
      return $billon;
  }

  public function getactiveAttribute(){
    if($this->StatusB==0){
        return 'Đang phục vụ';
    }else{
        return 'Đã hoàn thành';
    }

}
    //thon tin chi tiet tu bill

    // public static function bill(){
    //     $info=Bills::find();
    //     $user=$info->user;
    //     $table=$info->table;
    //     $customer=$info->customer;
    //     return ['infor'=>$info,'user'=>$user,'table'=>$table,'cus'=>$customer];
    // }

public function user()
{
    return $this->belongsTo(Users::class,'IdUser');
}


public function table()
{
    return $this->belongsTo(Tables::class,'IdTable');
}


public function customer()
{
    return $this->belongsTo(Customers::class,'IdCustomer');
}


    // public function getStatusAttribute(){
    //     if($this->)
    // }



}
