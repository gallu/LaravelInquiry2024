<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Models\ExamUser;

use App\Http\Requests\ExamDbRequest;

class ExamDbController extends Controller
{
    //
    public function index() {
        return view('exam/db/index');
    }

    public function fin(ExamDbRequest $req) {
        $data = $req->validated();
        // $data = $req->all();
        // var_dump($data);

        $r = ExamUser::create($data);
        var_dump($r?->toArray());

        $context = [
            'name' => $data['name'],
            'email' => $data['email'],
            'memo' => $data['memo'],
        ];

        return view('exam/db/fin', $context);
    }
}

