@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('btn_mng_state')

@endsection

@section('content')
<section class="form">
    <div class="form__outer">
        <h2 class="form__title">会員登録</h2>
        <div class="form__form-wrapper">
        <form class="form__form" action="/register" method="POST">
            @csrf
            <div class="form__form-item">
                <div class="form__form-item-content">
                    <div class="form__input--text">
                        <input type="text" class="form__input" name="name" id="name" value="{{ old('name') }}" placeholder="名前" />
                    </div>
                    @if ($errors->has('name'))
                    <div class="form__error">
                        {{$errors->first('name')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form__form-item">
                <div class="form__form-item-content">
                    <div class="form__input--text">
                        <input type="text" class="form__input" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレス" />
                    </div>
                    @if ($errors->has('email'))
                    <div class="form__error">
                        {{$errors->first('email')}}
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
                <div class="form__form-item-content">
                    <div class="form__input--text">
                        <input type="password" class="form__input" name="password_confirmation" id="password_confirmation" placeholder="確認用パスワード" />
                    </div>
                </div>
            </div>
            <div class="form__form-item">
                <button class="form__button-submit" type="submit">会員登録</button>
            </div>
            <div class="form__sup">アカウントをお持ちの方はこちらから<br>
                <a href="/login">ログイン</a>
            </div>
        </form>
        </div>
    </div>
</section>
@endsection