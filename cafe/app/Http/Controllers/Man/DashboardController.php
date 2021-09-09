<?php
namespace App\Http\Controllers\Man;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Customers;
use App\Models\Tables;
use App\Models\BillS;
use App\Models\billdetail;
use App\Models\Receipts;
use App\Models\Storecepipts;
use App\Models\Payslips;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function time(){
        $time=['06','08','10','12','14','16','18','20','22'];
        $count=count($time);
        $i=0;
        $today = date("Y-m-d");
        for($i;$i<$count;$i++){
            $start=$time[$i].":00:00";
            $lasttime=$time[$i]+2;
            if($lasttime==8){
                $lasttime='08';
            }
            $end=$lasttime.":00:00";
            $name=$time[$i]."-".$lasttime;
            $recep=Receipts::whereDate('created_at',$today)->whereTime('created_at', '>', $start)->whereTime('created_at', '<', $end)->get();
            $pay=Payslips::whereDate('created_at',$today)->whereTime('created_at', '>', $start)->whereTime('created_at', '<', $end)->get();
            $sum=0;
            $sum1=0;
            foreach($recep as $value){
                $sum=$sum+$value->Totalprice;
            }
            foreach($pay as $value1){
                $sum1=$sum1+$value1->Totalprice;
            }

            $list=[
                'time'=>$name,
                'recep'=>$sum,
                'pay'=>$sum1,
            ];      
            $arr[$name]=$list;
        }

        return $arr;
    }

    public static function menu(){
        $today = date("Y-m-d");
        $menu=Menus::index();
        $i=0;
        foreach($menu as $key){
            $sum=0;
            $detail=billdetail::join('bill','billdetail.IdBill','=','bill.IdBill')->whereDate('created_at','=',$today)->where('IdMenu','=',$key->IdMenu)->get();

            foreach($detail as $key1){
                $sum=$sum+$key1->Quantity;
            }

            $list=[
                'name'=>$key->NameMenu,
                'count'=>$sum
            ];

            $arr[$i++]=$list;
        }

        return $arr;
    }
    public function index()
    {
        $check0=DashboardController::check0();
        $count0=DashboardController::count0();
        $check1=DashboardController::check1();
        $count1=DashboardController::count1();
        $check2=DashboardController::check2();
        $count2=DashboardController::count2();
        $arr=DashboardController::time();
        $arr1=DashboardController::menu();
        return view('Man.dashboard',['check0'=>$check0,'count0'=>$count0,'check1'=>$check1,'count1'=>$count1,'check2'=>$check2,'count2'=>$count2,'ballot'=>$arr,'sort'=>$arr1]);
        
    }

    public static function check2(){
        $today = date("Y-m-d");
        $bill=Storecepipts::whereDate('created_at', $today)->get();
        $sum=0;
        foreach($bill as $value){
            $sum= $sum + $value->Totalprice;
        }
        return $sum;
    }

    public static function count2(){
        $today = date("Y-m-d");
        $bill=Storecepipts::whereDate('created_at', $today)->count();
        return $bill;
    }

    public static function check0(){
        $today = date("Y-m-d");
        $bill=Bills::where('StatusB','=',0)->whereDate('created_at', $today)->get();
        $sum=0;
        foreach($bill as $value){
            $sum= $sum + $value->Totalprice;
        }
        return $sum;
    }

    public static function count0(){
        $today = date("Y-m-d");
        $bill=Bills::where('StatusB','=',0)->whereDate('created_at', $today)->count();
        return $bill;
    }

    public function count1(){
        $today = date("Y-m-d");
        $bill=Bills::where('StatusB','=',1)->whereDate('created_at', $today)->count();
        return $bill;
    }


    public function check1(){
        $today = date("Y-m-d");
        $bill=Bills::where('StatusB','=',1)->whereDate('created_at', $today)->get();
        $sum=0;
        foreach($bill as $value){
            $sum= $sum + $value->Totalprice;
        }

        return $sum;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
