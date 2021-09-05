<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Storecepipts;
use App\Models\Receiptdetail;

class BallotController extends Controller
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
        $table=Storecepipts::offset($start)->limit(10)->get();
        $j=0;
        foreach($table as $value){
            $hi=Receiptdetail::where('Idreceipt','=',$value->Idreceipt)->get();
            $i=0;
            foreach($hi as $value1){
                $list2=[
                    'DetaiId'=>$value1->DetaiId,
                    'Idreceipt'=>$value1->Idreceipt,
                    'IdProduct'=>$value1->pro,
                    'Unit'=>$value1->unit,
                    'Quantity'=>$value1->Quantity,
                    'Price'=>$value1->Price
                ];

                $arr[$i++]=$list2;
            }
            $list=[
                'Idreceipt'=>$value->Idreceipt,
                'IdUser'=>$value->user,
                'IdSupplier'=>$value->Supplier,
                'Note'=>$value->Note,
                'Paymentmethod'=>1,
                'Totalprice'=>$value->Totalprice,
                'Time'=>$value->created_at,
                'detail'=>$arr
            ];

            $array[$j++]=$list;
        }
        return view('Man.Ballot.view',['li'=>$array]);
    }


    public static function ballot(){
        $info=Storecepipts::offset(0)->limit(10)->get();
        $count=Storecepipts::count();
        $j=0;
        foreach($info as $value){
            $hi=Receiptdetail::where('Idreceipt','=',$value->Idreceipt)->get();
            $i=0;
            foreach($hi as $value1){
                $list2=[
                    'DetaiId'=>$value1->DetaiId,
                    'Idreceipt'=>$value1->Idreceipt,
                    'IdProduct'=>$value1->pro,
                    'Unit'=>$value1->unit,
                    'Quantity'=>$value1->Quantity,
                    'Price'=>$value1->Price
                ];

                $arr[$i++]=$list2;
            }
            $list=[
                'Idreceipt'=>$value->Idreceipt,
                'IdUser'=>$value->user,
                'IdSupplier'=>$value->Supplier,
                'Note'=>$value->Note,
                'Paymentmethod'=>1,
                'Totalprice'=>$value->Totalprice,
                'Time'=>$value->created_at,
                'detail'=>$arr
            ];

            $array[$j++]=$list;
        }

        return view('Man.Ballot.warehousing',['li'=>$array,'count'=>$count]);
    }
    


    public function index()
    {
        //
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
