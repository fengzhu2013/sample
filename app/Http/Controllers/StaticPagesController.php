<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 渲染首页，帮助页及关于页
 */
class StaticPagesController extends Controller
{
    //

    public function home()
    {
        return view('static_pages/home');
    }


    public function help()
    {
        return view('static_pages/help');;
    }


    /**
     * @return [type]
     */
    public function about()
    {
        return view('static_pages/about');
    }


}
