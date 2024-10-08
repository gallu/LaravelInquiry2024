{{-- inquiry/index.blade.php --}}
@extends('inquiry.layout')

@section('title', '入力')

@section('content')
<h1>問い合わせフォーム</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/inquiry" method="POST">
@csrf
お名前     <input type="text" name="name" value="{{ old("name") }}"><br>
電話番号   <input type="text" name="tel" value="{{ old("tel") }}"><br>
emailアドレス<input type="text" name="email" value="{{ old("email") }}"><br>
*タイトル    <input type="text" name="title" value="{{ old("title") }}"><br>
*本文      <textarea name="body">{{ old("body") }}</textarea><br>
<button class="btn btn-primary">送信</button>
</form>
@endsection
