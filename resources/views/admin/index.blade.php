{{-- index.blade.php --}}
@extends('admin.layout')

@section('title', '管理画面入口')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        ・{{ $error }}<br>
    @endforeach
    </div>
@endif

<form action="/admin/login" method="post">
    @csrf
    email：<input name="email" value="{{ old('email') }}"><br>
    パスワード：<input  name="password" type="password"><br>
    <button>送信する</button>
</form>

@endsection