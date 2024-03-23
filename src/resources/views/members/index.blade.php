@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/members/index.css') }}">
<style>
  svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 30px;
  }
</style>
@endsection

@section('btn_mng_state')
    <div class="header__membermenu">
        <a href="/" class="header__menu-textbtn">ホーム</a>
        <a href="/attendance/myachievement" class="header__menu-textbtn">勤務実績</a>
        <a href="/members" class="header__menu-textbtn">ユーザー一覧</a>
        <a href="/attendance" class="header__menu-textbtn">日付一覧</a>
        <form action="/logout" method="POST" class="header__menu-form">@csrf<button type="submit" class="header__menu-formbtn">ログアウト</button></form>
    </div>
@endsection

@section('content')
<section class="attendance">
    <div class="attendance__outer">
        <h2 class="attendance__title">
            <div class="attendance__title-navi-day" >ユーザー一覧</div>
        </h2>

            <table class="attendance__indextable">
                <tbody class="attendance__indextable-body">
                    <tr class="attendance__indextable-header">
                        <td>ユーザーID</td><td>名前</td><td>メールアドレス</td>
                    </tr>                    
                    @foreach ($members as $member)
                    <tr class="attendance__indextable-row">
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="attendance__indextable-paginate">{{ $members->links() }}</div>

        </div>
    </div>
</section>
@endsection