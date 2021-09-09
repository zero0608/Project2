<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payslips;
use App\Models\Users;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $receipt=Payslips::orderByDesc('payslips.created_at')->offset(0)->limit(10)->get();
        $count=Payslips::count();
        $user=Users::all();
        return view('Man.Receipt.payment',['pay'=>$receipt,'count'=>$count,'user'=>$user]);
    }

    public function pagination_pay(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        $pro=Payslips::orderByDesc('payslips.created_at')->offset($start)->limit(10)->get();
        
        return view('Man.Receipt.viewpay',['pay'=>$pro]);
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
         $validator = \Validator::make($request->all(),[
          'note'=>'required',
          'price'=>'required',
      ],[
       'note.required'=>'Note name is required',

       'price.required'=>'Price name is required',
   ]);
        if(!$validator->passes()){
         return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
     } else{
        Payslips::create([
            'UserId'=>$request->user,
            'IdStore'=>1,
            'Note'=>$request->note,
            'Totalprice'=>$request->price
        ]);
        return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
    }
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

    public function export() 
    {
        return Excel::download(new PaymentsExport, 'payslips.xlsx');

         //  route('admin.payment');

    }
}
