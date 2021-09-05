<?php

namespace App\Http\Controllers\Man;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Cate;
use Illuminate\Support\Facades\File;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function save(Request $request){

           $validator = \Validator::make($request->all(),[
              'name'=>'required',
              'code'=>'required',
              'price'=>'required',
              'unit'=>'required',
              'product_image'=>'required|image',
           ],[
               'name.required'=>'Product name is required',
               // 'name.string'=>'Product name must be a string',
               // 'name.unique'=>'This product name is already taken',
               'code.required'=>'Code name is required',
               // 'code.string'=>'Code name must be a string',
               // 'code.unique'=>'This Code name is already taken',
               'price.required'=>'Price name is required',
               // 'price.string'=>'Price name must be a string',
               // 'price.unique'=>'This price name is already taken',
               'unit.required'=>'Unit name is required',
               // 'unit.string'=>'Unit name must be a string',
               // 'unit.unique'=>'This Unit name is already taken',
               'product_image.required'=>'Product image is required',
               'product_image.image'=>'Product file must be an image',
           ]);
           $sql=Menus::where('IdMenu','=',$request->code)->first();

           if($sql===null){
            if(!$validator->passes()){
               return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
           }
           else{
             $path = 'assets/images';
             $file = $request->file('product_image');
             $file_name = time().'_'.$file->getClientOriginalName();

             // $upload = $file->storeAs($path, $file_name);
             $upload = $file->storeAs($path, $file_name, 'public');

             if($upload){
                   Menus::create([
                       'IdMenu'=>$request->code,
                       'NameMenu'=>$request->name,
                       'Price'=>$request->price,
                       'Unit'=>$request->unit,
                       'Images'=>$file_name,
                       'Idcate'=>$request->cate,
                       'active'=>0,
                   ]);
                 return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
             }
           }
       }else{
            return response()->json(['code'=>2,'msg'=>'Mã sản phẩm bị trùng']);       
         } 
       }


    public function pagination_menu(Request $request){
        $current_page=$request->current_page;
        $limit=6;
        $start =($current_page-1)*$limit;
        $menu=Menus::menuall($start);
        $cate=Cate::all();
        return view('Man.Menu.view',['menu'=>$menu,'cate'=>$cate]);

    }


      public function key(Request $request){
        $status=$request->status;
        $id=$request->id;
        if($status==0){
            Menus::where('IdMenu','=',$id)->update(['active' => 1]);
        }else{
            Menus::where('IdMenu','=',$id)->update(['active' => 0]);
        }
    }


      public function search_option(Request $request)
    {
        $option=$request->option;

        if($option==0){
             $menu=Menus::menuall(0);
        }else{
         $menu=Menus::where('Idcate','=',$option)->get();
        }
         $cate=Cate::all();
        // dd($table);
         return view('Man.Menu.view',['menu'=>$menu,'cate'=>$cate]);
    }

    public function index()
    {
       $menu=Menus::menuall(0);
       $countmenu=Menus::count();
       $cate=Cate::all();
       return view('Man.Menu.Menu',['menu'=>$menu,'count'=>$countmenu,'cate'=>$cate]);
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
        $post=Menus::findOrFail($id);
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
       'NameMenu'=>$request->name,
       'Price'=>$request->price,
       'Unit'=>$request->unit,
       'Images'=>$post->Images,
       'Idcate'=>$request->cate,
   ]);

         return redirect("admin/product1");
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
