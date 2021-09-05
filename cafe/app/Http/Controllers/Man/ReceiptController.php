<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipts;
use App\Models\Users;
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipt=Receipts::offset(0)->limit(10)->get();
        $count=Receipts::count();
        $user=Users::all();
        return view('Man.Receipt.receipts',['re'=>$receipt,'count'=>$count,'user'=>$user]);
    }
    public function pagination_re(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        $pro=Receipts::offset($start)->limit(10)->get();
        return view('Man.Receipt.viewre',['re'=>$pro,]);
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
        Receipts::create([
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


    
}
