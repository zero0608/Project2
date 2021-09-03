<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Users;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function append(Request $request){
        $id_menu=$request->id_menu;
        $data=Products::where('IdProduct','=',$id_menu)->first();
        // $data=Products::all();
        // dd($data);
        return view('Man.Product.appendproduct',['data'=>$data]);
    }

    public function searchmenu(Request $request){
    $name=$request->menuname;
    $data=Products::where('IdProduct', 'like','%'.$name.'%')->orWhere('NameProduct', 'like',$name.'%')->get();
    // dd($data);
    return view('Man.Product.searchmenu',['data'=>$data]);
    }


    public function index()
    {
        $pro=Products::all();
        $sup=Suppliers::all();
        $user=Users::all();
        return view('Man.Product.importwarehosing',['pro'=>$pro,'sup'=>$sup,'user'=>$user]);
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
