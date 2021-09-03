<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Cate;
class Menus extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'IdMenu';
    protected $keyType = 'string';
    // (khóa chính là kiểu string)
    // public $timestamps = false;(k cho thoi gian hđ)
     protected $fillable = [
        'IdMenu',
        'NameMenu',
        'Price',
        'Images',
        'Unit',
        'Idcate',
        'active',
    ];


    public static function index(){
      $menu=Menus::all();
      return $menu;
    }


    public static function menuall($start){
      $menu=Menus::join('categories','menus.Idcate','=','categories.Idcate')->offset($start)->limit(6)->get();
      return $menu;
    }


    public static function findid($idmenu){
      $menuid=Menus::find($idmenu);
      return $menuid;
    }

    public static function findidcate($idcate){
      $cateid=Menus::where('Idcate', $idcate)->get();
      return $cateid;
    }

    public static function search($name){
      $search=Menus::where('IdMenu', 'like','%'.$name.'%')->orWhere('NameMenu', 'like',$name.'%')->get();
      return $search;
    }

    public function getcheckAttribute(){
      $id=$this->Idcate;
      $Cate=Cate::find($id);
      return $Cate->CateName;
    }

    public function getcheck1Attribute(){
      if($this->active==0){
        return 'KHÓA';
      }
      if($this->active==1){
        return 'BẬT';
      }
    }


}
