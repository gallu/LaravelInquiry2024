{{-- admin/inquiry/detail.blade.php --}}
@extends('admin.layout')

@section('title', '管理画面 問い合わせ詳細')

@section('content')

<table class="table table-hover table-bordered">
<tr>
  <th>id
  <td>{{ $inquiry->id }}
<tr>
  <th>問い合わせ日時
  <td>{{ $inquiry->created_at->format("Y/m/d H:i") }}
<tr>
  <th>お名前
  <td>{{ $inquiry->name }}
<tr>
  <th>電話番号
  <td>{{ $inquiry->tel }}
<tr>
  <th>email
  <td>{{ $inquiry->email }}
<tr>
  <th>タイトル
  <td>{{ $inquiry->title }}
<tr>
  <th>本文
  <td>{{ $inquiry->body }}

<tr>
  <th>返信ステータス
  <td>{{ $inquiry->reply_status }}
<tr>
  <th>返信内容
  <td>{{ $inquiry->reply_body }}
<tr>
  <th>返信日時
  <td>{{ $inquiry->reply_at }}
<tr>
  <th>返信担当者ID
  <td>{{ $inquiry->reply_admin_id }}

</table>

@if ($errors->any())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        ・{{ $error }}<br>
    @endforeach
    </div>
@endif

@if (null === $inquiry->reply_at) 
<form action="/admin/inquiry/reply" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $inquiry->id }}">
返信ステータス: 
    <label><input type="radio" name="reply_status" value="返信不要" {{ old('reply_status') === '返信不要' ? 'checked':'' }} >返信不要</label>
    <label><input type="radio" name="reply_status" value="電話で返信した" {{ old('reply_status') === '電話で返信した' ? 'checked':'' }} >電話で返信した</label>
    <label><input type="radio" name="reply_status" value="emailで返信した" {{ old('reply_status') === 'emailで返信した' ? 'checked':'' }}>emailで返信した</label>
    <label><input type="radio" name="reply_status" value="その他で返信した" {{ old('reply_status') === 'その他で返信した' ? 'checked':'' }}>その他で返信した</label>
    <br>
返信内容:<textarea name="reply_body">{{ old('reply_body') }}</textarea><br>
<button class="btn btn-primary">送信する</button>
</form>
@endif
@endsection
