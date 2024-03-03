@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('btn_mng_state')
    <div class="header__membermenu">
        <a href="/" class="header__menu-textbtn">ホーム</a>
        <a href="/attendance/myachievement" class="header__menu-textbtn">勤務実績</a>
        <a href="/members" class="header__menu-textbtn">ユーザー一覧</a>
        <a href="/attendance/" class="header__menu-textbtn">日付一覧</a>
        <form action="/logout" method="POST" class="header__menu-form">@csrf<button type="submit" class="header__menu-formbtn">ログアウト</button></form>
    </div>
@endsection

@section('content')
<section class="timecard">
    <div class="timecard__outer">
        <h2 class="timecard__title">{{ $name }}さんお疲れ様です！</h2>
        <div class="timecard__attendance-button-wrapper">
            @if ($att_start)
                <form class="timecard__attendance-button-form" action="/attendance/start" method="GET">
                    @csrf
                    <button type="submit" class="timecard__attendance-button">勤務開始</button>
                </form>
            @else
                <form class="timecard__attendance-button-form">
                    @csrf
                    <button type="submit" class="timecard__attendance-button--disable" disabled>勤務開始</button>
                </form>
            @endif

            @if ($att_over)
                <form class="timecard__attendance-button-form" action="/attendance/end" method="GET">
                    @csrf
                    <button type="submit" class="timecard__attendance-button">勤務終了</button>
                </form>
            @else
                <form class="timecard__attendance-button-form">
                    @csrf
                    <button type="submit" class="timecard__attendance-button--disable" disabled>勤務終了</button>
                </form>
            @endif

            @if ($break_start)
                <form class="timecard__attendance-button-form" action="/break/start" method="GET">
                    @csrf
                    <button type="submit" class="timecard__attendance-button">休憩開始</button>
                </form>
            @else
                <form class="timecard__attendance-button-form">
                    @csrf
                    <button type="submit" class="timecard__attendance-button--disable" disabled>休憩開始</button>
                </form>
            @endif

            @if ($break_over)
                <form class="timecard__attendance-button-form" action="/break/end" method="GET">
                    @csrf
                    <button type="submit" class="timecard__attendance-button">休憩終了</button>
                </form>
            @else
                <form class="timecard__attendance-button-form">
                    @csrf
                    <button type="submit" class="timecard__attendance-button--disable" disabled>休憩終了</button>
                </form>
            @endif


        </div>
    </div>
</section>
@endsection