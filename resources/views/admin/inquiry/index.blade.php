{{-- admin/inquiry/index.blade.php --}}
@extends('admin.layout')

@section('title', '管理画面 問い合わせ一覧')

@section('content')

<form>
    <label><input type="checkbox" name="filter_reply" value="1"
    @if ($filter_reply === '1')
        checked
    @endif
    >未返信のみ</label>
    <button class="btn btn-sm btn-primary">絞り込む</button>
</form>

<table class="table table-hover table-bordered">
<tr>
  <th>id
  <th>返信
  <th>問い合わせ日時 <a href="?sort=created_at_desc">▼</a> <a href="?sort=created_at_asc">▲</a>
  <th>お名前
  <th>電話番号
  <th>email
  <th>タイトル <a href="?sort=title_desc">▼</a> <a href="?sort=title_asc">▲</a>
@foreach ($inquiry_list as $datum)
<tr>
  <td>{{ $datum->id }}
  <td>
    @if (null !== $datum->reply_at)
        済
    @endif
  <td>{{ $datum->created_at->format("Y/m/d H:i") }}
  <td>{{ $datum->name }}
  <td>{{ $datum->tel }}
  <td>{{ $datum->email }}
  <td>{{ $datum->title }}
  <td><a href="/admin/inquiry/{{ $datum->id }}" class="btn btn-primary">詳細画面へ</a>
@endforeach
</table>

@endsection
