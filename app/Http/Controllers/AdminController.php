<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginPostRequest;

class AdminController extends Controller
{
    //
    public function index() {
        return view('admin/index');
    }

    public function login(LoginPostRequest $req) {
        // 入力データの取得
        $credential = $req->validated();
        // var_dump($credential);

        // 認証の確認
        $r = Auth::attempt($credential);
        // var_dump($r);
        
        // errorなら入力画面に突っ返す
        if (false === $r) {
            return back()
                   ->withInput() // 入力値の保持
                   ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]) // エラーメッセージの出力
                   ;
        }

        // OKなら「ログイン後画面」に遷移
        $req->session()->regenerate(); // セキュリティ対策
        return redirect()->route('admin.top');
    }

    // ログイン後TopPage
    public function top() {
        // XXX (後で)移動
        return view('admin/top');
    }

}
