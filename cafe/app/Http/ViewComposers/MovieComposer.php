<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Areas;
use App\Models\Cate;
use App\Models\Menus;
use App\Models\Tables;
class MovieComposer
{
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // get all category (for demo purpose)
        $area = Areas::all();
        // dd($area);
        $cate=Cate::all();
        $table=Tables::all();
        $menu=Menus::all();
	    
	// bind to view
        $view->with('cate',$cate)->with('area',$area)->with('menu',$menu)->with('table',$table);
    }
}