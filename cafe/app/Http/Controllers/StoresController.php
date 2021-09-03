<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Areas;
class StoresController extends Controller
{
    public function hi()
    {
        $ka=Areas::index();
         return view('Pos.index', [
            'ka' => $ka
        ]);
    }
}
