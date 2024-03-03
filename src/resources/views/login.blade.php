@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('btn_mng_state')

@endsection

@section('content')
<section class="form">
    <div class="form__outer">
        <h2 class="form__title">ログイン</h2>
        <div class="form__form-wrapper">
        <form class="form__form" action="/login" method="POST">
            @csrf
            <div class="form__form-item">
                <div class="form__form-item-content">
                    <div class="form__input--text">
                        <input type="text" class="form__input" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレス" />
                    </div>
                    @if ($errors->has('password'))
                    <div class="form__error">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form__form-item">
                <div class="form__form-item-content">
                    <div class="form__input--text">
                        <input type="password" class="form__input" name="password" id="password" value="{{ old('email') }}" placeholder="パスワード" />
                    </div>
                    @if ($errors->has('password'))
                    <div class="form__error">
                        {{$errors->first('password')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form__form-item">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
            <div class="form__sup">アカウントをお持ちでない方はこちらから<br>
                <a href="/register">会員登録</a>
            </div>
        </form>
        </div>
    </div>
</section>
@endsection