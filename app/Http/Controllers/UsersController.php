<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }



    /**
     * 展示用户注册页面
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function store(Request $request)
    {
        //数据校验
        $this->validate($request, [
            'name'      => 'required|max:50',
            'email'     => 'required|email|unique:users|max:255',
            'password'  => 'required|confirmed|min:6'
        ]);


        //插入数据库
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        if (is_null($user)) {
            //提示错误信息
        }

        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
        //重定向
        return redirect()->route('users.show',[$user]);
    }

}
