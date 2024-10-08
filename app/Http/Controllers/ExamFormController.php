<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ExamFormRequest;

class ExamFormController extends Controller
{
    //
    public function index() {
        return view('exam/form/index');
    }

    public function fin(ExamFormRequest $req) {
        $data = $req->validated();
        // var_dump($data);

        $context = [
            'name' => $data['name'],
            'memo' => $data['memo'],
        ];

        return view('exam/form/fin', $context);
    }
}
