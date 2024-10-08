{{-- exam/db/index.blade.php --}}
<html>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/db/form/fin" method="post">
@csrf
名前(name): <input type="text" name="name" value="{{ old("name") }}"><br>
メールアドレス(email): <input type="text" name="email" value="{{ old("email") }}"><br>
めも(memo)<textarea name="memo">{{ old("memo") }}</textarea><br>
<button>送信</button>
</form>

</html>