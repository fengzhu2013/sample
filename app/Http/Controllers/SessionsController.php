<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    /**
     * 显示登陆页面
     * @return [type] [description]
     */
    public function create()
    {
        return view('sessions.create');
    }


    /**
     * 登陆
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        //数据校验
        $credentials = $this->validate($request,[
            'email'     => 'required|email|max:255',
            'password'  => 'required|',
        ]);

        //逻辑处理
        if (Auth::attempt($credentials,$request->has('remember'))) {
            //登陆成功
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            //登陆失败
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }

    }

    /**
     * 注销登陆
     * @return [type] [description]
     */
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','您已成功退出');
        return redirect('login');
    }


}
