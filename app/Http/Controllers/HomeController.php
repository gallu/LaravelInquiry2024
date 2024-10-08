<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index() {
        // $con = DB::connection()->getPdo();
        // var_dump($con);
        return view('index');
    }

    public function second() {
        $raw_pass = 'password';

        $h_pass = md5($raw_pass);
        var_dump($h_pass);
        echo "<br>";

        $h_pass = sha1($raw_pass);
        var_dump($h_pass);
        echo "<br>";

        $h_pass = password_hash($raw_pass, PASSWORD_DEFAULT);
        var_dump($h_pass);
        echo "<br>";

    }
}
