<?php

namespace App\Http\Controllers\Man;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillS;
use App\Models\billdetail;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagination(Request $request)
    {
        $current_page=$request->current_page;
        $limit=10;
        $start =($current_page-1)*$limit;
         $info=Bills::join('users','users.UserId', '=','bill.IdUser')->join('tables','tables.IdTable', '=','bill.IdTable')->join('customers','customers.IdCustomer','=','bill.IdCustomer')->select('bill.*', 'users.UserName', 'customers.CustomerName','tables.TableName')->offset($start)->limit(10)->get();
        $j=0;
         foreach($info as $value){
            // echo $i++;
            $hi=billdetail::findbill($value->IdBill);
            $i=0;
            foreach($hi as $value1){
                $list2=[
                    'idmenu'=>$value1->IdMenu,
                    'namemenu'=>$value1->NameMenu,
                    'quantity'=>$value1->Quantity,
                    'unit'=>$value1->Unit,
                    'price'=>$value1->Price
                ];
                $array1[$i++]=$list2;
            }
            $list=[
                'id_bill'=>$value->IdBill,
                'time'=>$value->created_at,
                'price'=>$value->Totalprice,
                'note'=>$value->Note,
                'status'=>$value->StatusB,
                'nameuser'=>$value->UserName,
                'namecus'=>$value->CustomerName,
                'tablename'=>$value->TableName,
                'detail'=>$array1
            ];
            $array[$j++]=$list;
        }
        return view('Man.bill.view',['li'=>$array]);
    }


    public static function bill(){
        $info=Bills::join('users','users.UserId', '=','bill.IdUser')->join('tables','tables.IdTable', '=','bill.IdTable')->join('customers','customers.IdCustomer','=','bill.IdCustomer')->select('bill.*', 'users.UserName', 'customers.CustomerName','tables.TableName')->offset(0)->limit(10)->get();
        $j=0;
        $count=Bills::count();
        foreach($info as $value){
            // echo $i++;
            $hi=billdetail::findbill($value->IdBill);
            $i=0;
            foreach($hi as $value1){
                $list2=[
                    'idmenu'=>$value1->IdMenu,
                    'namemenu'=>$value1->NameMenu,
                    'quantity'=>$value1->Quantity,
                    'unit'=>$value1->Unit,
                    'price'=>$value1->Price
                ];
                $array1[$i++]=$list2;
            }
            $list=[
                'id_bill'=>$value->IdBill,
                'time'=>$value->created_at,
                'price'=>$value->Totalprice,
                'note'=>$value->Note,
                'status'=>$value->StatusB,
                'nameuser'=>$value->UserName,
                'namecus'=>$value->CustomerName,
                'tablename'=>$value->TableName,
                'detail'=>$array1
            ];
            $array[$j++]=$list;
        }
        return view('Man.bill.orders',['li'=>$array,'count'=>$count]);
    }
    
    public function index()
    {
        
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
