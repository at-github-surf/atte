<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__outer">
            <div class="header__inner">
                <div><h1 class="header__sitetitle">Atte</h1></div>
                @yield('btn_mng_state')
            </div>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
</body>

</html>