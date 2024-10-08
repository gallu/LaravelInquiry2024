<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\InquiryPostRequest;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Log;
// use LogicException;
// use PDOException;

class InquiryController extends Controller
{
    //
    public function index() {
        return view('inquiry/index');
    }

    public function store(InquiryPostRequest $req) {
        try {
            // echo "aaa";
            // $datum = $req->all();
            $datum = $req->validated();
            // var_dump($datum);

            // 例外処理とエラー時の対応
            $r = Inquiry::create($datum);
            // var_dump( $r->toArray() );
        } catch(\LogicException $e) {
            Log::error("Inquiry create error:" . $e->getMessage());
            return redirect()->route('inquiry.error');
        } catch(\PDOException $e) {
            Log::error("Inquiry create error(PDO):" . $e->getMessage());
            return redirect()->route('inquiry.error');
        }

        //
        return redirect()->route('inquiry.fin');
    }

    public function fin() {
        // echo "fin";
        return view('inquiry/fin');
    }

    public function error() {
        // return view('inquiry/create_error');
        echo "error";
    }
}
