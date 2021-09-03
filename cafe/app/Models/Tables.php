<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tables extends Model
{
    use HasFactory;
    protected $table = 'tables';
    protected $primaryKey = 'IdTable';
    // protected $keyType = 'string';(khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdTable',
        'TableName',
        'Status',
        'active',
        'IdArea',
    ];


    public static function alltable($start)
    {
        $table=Tables::join('areas','tables.IdArea','=','areas.IdArea') ->offset($start)->limit(10)->get();
        return $table;
    }

     public static function index()
    {
        $table=Tables::all();
        return $table;
    }

     public static function findid($idtable)
    {
        $tableid=Tables::find($idtable);
        return $tableid;
    }

    public static function findidarea($idarea)
    {
        $areaid=Tables::where('tables.IdArea', $idarea)->get();
        return $areaid;
    }
    
    public function getcheckAttribute(){
        if($this->Status==0){
            return 'Đang trống';
        }else{
            return 'Đang có khách';
        }
    }
    public function getcheck2Attribute(){
        if($this->active==0){
            return 'Đang hoạt động';
        }else{
            return 'Đã ngừng';
        }
    }
    public function getbuttonAttribute(){
        if($this->active==0){
            return 'Ngừng hoạt động';
        }else{
            return 'Kích hoạt';
        }
    }

}
