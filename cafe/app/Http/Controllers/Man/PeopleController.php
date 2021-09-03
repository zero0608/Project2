<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Suppliers;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cus=Customers::customall(0);
        $countcus=Customers::count();
        $sup=Suppliers::suppall(0);
        $countsup=Suppliers::count();
        return view('Man.people.customer',['cus'=>$cus,'countcus'=>$countcus,'sup'=>$sup,'countsup'=>$countsup]);
    }
    public function pagination_cus(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        $cus=Customers::customall($start);
        return view('Man.people.viewcus',['cus'=>$cus]);
    }
    public function pagination_sup(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        // $sup=Suppliers::all();
        // dd($sup);
        $sup=Suppliers::suppall($start);
        return view('Man.people.viewsup',['sup'=>$sup]);

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
        $check=$request->check;
        $code=$request->code;
        $name=$request->name;
        $email=$request->email;
        $phone=$request->phone;
        $address=$request->address;

        if($check==0){
            $sql=Suppliers::where('IdSupplier','=',$code)->first();
        }

        if($check==1){
            $sql =Customers::where('IdCustomer','=',$code)->first();
        }

        if($sql===null){
            if($check ==0){
                $sql2=Suppliers::create([
                    'IdSupplier'=>$code,
                    'Namesupplier'=>$name,
                    'Email'=>$email,
                    'Phone'=>$phone,
                    'Address'=>$address
                ]);
            }

            if($check==1){
                $sql2=Customers::create([
                    'IdCustomer'=>$code,
                    'CustomerName'=>$name,
                    'Email'=>$email,
                    'PhoneNumber'=>$phone,
                    'Address'=>$address
                ]);
            }

            echo '1';
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
        $check=$request->check;
        // $code=$request->code;
        $name=$request->name;
        $email=$request->email;
        $phone=$request->phone;
        $address=$request->address;

        if($check==0){
            $sql=Suppliers::where('IdSupplier','=',$email)->first();
        }

        if($check==1){
            $sql =Customers::where('IdCustomer','=',$email)->first();
        }

        if($sql===null){
            if($check ==0){
                $sql2=Suppliers::where('IdSupplier','=',$id)->update([
                    'Namesupplier'=>$name,
                    'Email'=>$email,
                    'Phone'=>$phone,
                    'Address'=>$address
                ]);
            }

            if($check==1){
                $sql2=Customers::where('IdCustomer','=',$id)->update([
                    'CustomerName'=>$name,
                    'Email'=>$email,
                    'PhoneNumber'=>$phone,
                    'Address'=>$address
                ]);
            }
            echo '1';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sql=Suppliers::find($id);
        $sql->delete();
        echo '0';
    }

    public function destroy1(Request $request)
    {
     $id=$request->id;
     $sql =Customers::find($id);
     $sql->delete();
     echo '0';
    }

 }
