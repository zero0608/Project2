<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Users;
use App\Models\Storecepipts;
use App\Models\Receiptdetail;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        $pro=Products::offset(0)->limit(10)->get();
        $count=Products::count();
        $sup=Suppliers::all();
        return view('Man.Mypro.merchandise',['pro'=>$pro,'sup'=>$sup,'count'=>$count]);
    }

     public function pagination_pro(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        $pro=Products::offset($start)->limit(10)->get();
        $sup=Suppliers::all();
        return view('Man.Mypro.view',['pro'=>$pro,'sup'=>$sup]);
    }
    public function key(Request $request){
        $status=$request->status;
        $id=$request->id;
        if($status==0){
            Products::where('IdProduct','=',$id)->update(['active' => 1]);
        }else{
            Products::where('IdProduct','=',$id)->update(['active' => 0]);
        }
    }


    public function save1(Request $request){

       $validator = \Validator::make($request->all(),[
          'name'=>'required',
          'code'=>'required',
          'price'=>'required',
          'unit'=>'required',
          'product_image'=>'required|image',
      ],[
       'name.required'=>'Product name is required',

       'code.required'=>'Code name is required',

       'price.required'=>'Price name is required',

       'unit.required'=>'Unit name is required',

       'product_image.required'=>'Product image is required',
       'product_image.image'=>'Product file must be an image',
      ]);
       $sql=Products::where('IdProduct','=',$request->code)->first();

       if($sql===null){
        if(!$validator->passes()){
           return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        } else{
         $path = 'assets/images';
         $file = $request->file('product_image');
         $file_name = time().'_'.$file->getClientOriginalName();

             // $upload = $file->storeAs($path, $file_name);
         $upload = $file->storeAs($path, $file_name, 'public');

         if($upload){
           Products::create([
               'IdProduct'=>$request->code,
               'NameProduct'=>$request->name,
               'CostPrice'=>$request->price,
               'Unit'=>$request->unit,
               'Images'=>$file_name,
               'IdSupplier'=>$request->sup,
               'active'=>0,
           ]);
           return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
            }
        }
      
    }else{
        return response()->json(['code'=>2,'msg'=>'Mã sản phẩm bị trùng']);       
    } 
    }

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
        $post=Products::findOrFail($id);
        if($request->hasFile("product_image")){
         if (File::exists("assets/images".$post->Images)) {
             File::delete("assets/images".$post->Images);
         }
         $path = 'assets/images';
         $file=$request->file("product_image");
         $post->Images=time()."_".$file->getClientOriginalName();
         // $file->move(\public_path("/cover"),$post->cover);
         $upload = $file->storeAs($path, $post->Images, 'public');
         $request['product_image']=$post->Images;
     }

        $post->update([
       'NameProduct'=>$request->name,
       'CostPrice'=>$request->price,
       'Unit'=>$request->unit,
       'Images'=>$post->Images,
       'IdSupplier'=>$request->sup,
   ]);

         return redirect("admin/merchandise");
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


    public function save(Request $request){
        $json=$request->data;
        $sql =Storecepipts::count();
        $count = $sql+1;
        $idproduct = 'NH00'.$count;
        $user =$json['user'];
        $sup=$json['sup'];
        $pay = $json['pay'];
        $note = $json['note'];
        $insertorder=Storecepipts::create([
            'Idreceipt' => $idproduct,
            'IdUser' => $user,
            'IdSupplier' => $sup,
            'IdStore' =>1,
            'Note' =>$note,
            'Paymentmethod' =>0,
            'Totalprice' =>$pay
        ]);
        
        echo "<h3>Thông báo !</h3><p>Lưu đơn hàng thành công</p>";
        foreach ($json['detai_oder'] as $value) {
            if($value['id'] != 0){
                $id = $value['id'];
                $quantity = $value['quantity'];
                $price = $value['price'];
                $insertdetail=Receiptdetail::insert([
                    'Idreceipt' => $idproduct,
                    'IdProduct' => $id,
                    'Quantity' => $quantity,
                    'Price' =>$price,
                ]);
            }
        }
    }

    
}
