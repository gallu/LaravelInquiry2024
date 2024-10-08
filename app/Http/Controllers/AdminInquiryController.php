<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Http\Requests\AdminInquiryReply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminInquiryController extends Controller
{
    public function index(Request $req /* [TODO] 後でformリクエストに置き換える */) {
        //
        $filter_reply = $req->input('filter_reply');
        // var_dump($filter_reply);

        $sort = $req->input('sort');
		// var_dump($sort);

		// sort用のホワイトリスト
		$default_sort_key = 'created_at_desc';
		$sort_white_list = [
			'created_at_desc' => ['created_at', 'orderByDesc'],
			'created_at_asc'  => ['created_at', 'orderBy'],
			'title_desc'      => ['title', 'orderByDesc'],
			'title_asc'       => ['title', 'orderBy'],
		];
		// sort条件の取得
		$sort_condition = $sort_white_list[$sort] ?? $sort_white_list[$default_sort_key];
		// var_dump($sort_condition);

        /*
        $data = Inquiry::orderByDesc("created_at")
            ->offset(0)
            ->limit(50)
            ->get();
        */

		/*
        // 問い合わせの一覧を取得
        $obj = Inquiry::orderByDesc("created_at")
            ->offset(0)
            ->limit(50);
        // 絞り込む // [TODO] もう少し綺麗な書き方にする
        if ($filter_reply === '1') {
            $obj = $obj->whereNull('reply_at');
        }
        $data = $obj->get();
		*/

        // 問い合わせの一覧を取得
        $data = Inquiry::{$sort_condition[1]}($sort_condition[0])
            ->offset(0)
            ->limit(50)
			// フラグが立っていたら絞り込む
			->when($filter_reply === '1', function ($query, string $role) {
				$query->whereNull('reply_at');
			})
			->get();

        // var_dump($data->toArray());

        $context = [
            'inquiry_list' => $data,
            'filter_reply' => $filter_reply,
        ];

        return view('admin/inquiry/index', $context);
    }

    public function detail($id) {
        // echo "detail \n";
        // var_dump($id);

        $datum = Inquiry::find($id);
        // var_dump($datum?->toArray());
        // 該当レコードがない場合
        if (null === $datum) {
            // XXX エラーメッセージ追加
            return redirect()->route('admin.inquiry.index');
        }

        $context = [
            'inquiry' => $datum,
        ];

        return view('admin/inquiry/detail', $context);
    }

    public function reply(AdminInquiryReply $req) {
        // var_dump($req->all());
        $input = $req->validated();
        var_dump($input);


        // トラン開始
        DB::beginTransaction();

        // (データの取得
        $datum = Inquiry::find($input['id']);
        var_dump($datum->toArray());
        // 該当レコードがない場合
        if (null === $datum) {
            // XXX エラーメッセージ追加
            return redirect()->route('admin.inquiry.index');
        }

        // 「上書き」の抑止
        if (null !== $datum->reply_at) {
            // XXX 後でerrorコメント追加する
            // トランRollback
            DB::rollBack();
            // リダイレクト
            return redirect()->route('admin.inquiry.detail', ['id' => $input['id']]);
        }

        // update
        // $datum->reply_status = $input['reply_status'];
        // $datum->reply_body = $input['reply_body'];
        $rep_params = [
            'reply_status',
            'reply_body',
        ];
        foreach ($rep_params as $p) {
            $datum->$p = $input[$p];
        }
        $datum->reply_at = (Carbon::now())->format(DATE_ATOM);
        $datum->reply_admin_id = Auth::id();
        var_dump($datum->toArray());

        // 保存
        $datum->save();
        // トランcommit
        DB::commit();

        // mail送信がここに入る(予定)

        // リダイレクト
        return redirect()->route('admin.inquiry.detail', ['id' => $input['id']]);
    }
}
