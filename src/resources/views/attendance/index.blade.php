@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance/index.css') }}">
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
            <div class="attendance__title-naviwrap" ><a class="attendance__title-navi" href="/attendance/{{ $DateB }}"><</a></div>
            <div class="attendance__title-navi-day" >{{ $Date }}</div>
            <div class="attendance__title-naviwrap" ><a class="attendance__title-navi" href="/attendance/{{ $DateN }}">></a></div>
        </h2>

            <table class="attendance__indextable">
                <tbody class="attendance__indextable-body">
                    <tr class="attendance__indextable-header">
                        <td class="attendance__indextable-data--name">名前</td>
                        <td>勤務開始</td><td>勤務終了</td><td>休憩時間</td><td>勤務時間</td>
                    </tr>                    
                    @foreach ($att_records as $att_record)
                    <tr class="attendance__indextable-row">
                        <td class="attendance__indextable-data--name">{{ $att_record->name }}</td>
                        <td>{{ $att_record->working_at }}</td>
                        <td>{{ $att_record->closing_at }}</td>
                        <td>{{ $att_record->break_time }}</td>
                        <td>{{ $att_record->work_time }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $att_records->links() }}

        </div>
    </div>
</section>
@endsection