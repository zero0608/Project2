<?php

namespace App\Http\Controllers\Man;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tables;
use App\Models\Areas;
class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function key(Request $request){
        $status=$request->status;
        $id=$request->id;
        if($status==0){
            Tables::where('IdTable',$id)->update(['active' => 1]);
        }else{
            Tables::where('IdTable',$id)->update(['active' => 0]);
        }
    }
    public function search_option(Request $request)
    {
        $option=$request->option;

        if($option==0){
             $table=Tables::alltable(0);
        }else{
         $table=Tables::join('areas','tables.IdArea','=','areas.IdArea')->where('areas.IdArea','=',$option)->get();
        }
        $area=Areas::index();
        // dd($table);
         return view('Man.table.viewtable',['table'=>$table,'area'=>$area]);
    }

    public function pagination(Request $request)
    {
        $current_page=$request->current_page;
        $limit=10;
        $start =($current_page-1)*$limit;
        $table=Tables::alltable($start);
        $area=Areas::index();
        return view('Man.table.viewtable',['table'=>$table,'area'=>$area]);
    }

    public function index()
    {
        $table=Tables::alltable(0);
        $counttable=Tables::count();
        $area=Areas::index();
        return view('Man.table.table',['table'=>$table,'count'=>$counttable,'area'=>$area]);
        // return view('Man.table');
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
        $name=$request->tablename;
        $idarea=$request->idarea;
        $sql=Tables::where('TableName','=',$name)->first();
        // dd($sql);
        if($sql===null){
            $sql2=Tables::create([
                'TableName'=>$name,
                'Status'=>0,
                'IdArea'=>$idarea,
            ]);
            echo '1';
        }else{
            echo'0';
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
        $name=$request->tablename;
        $idarea=$request->idarea;
        $sql=Tables::where('TableName','=',$name)->where('IdArea','=',$idarea)->first();
        if($sql===null){
            $sql2=Tables::where('IdTable',$id)->update([
                'TableName' => $name,
                'IdArea' =>$idarea
            ]);
            echo '1';
        }else{
            echo'0';
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
        //
    }
}
