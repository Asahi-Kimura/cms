<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no,address=no,email=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="{{ asset('css/admin/reset-min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/cms-home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/contact-form.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/contents.css') }}" rel="stylesheet">
    
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    @yield('pageCss')
    </head>
    <body>
    @if( session('flash') )
        @foreach (session('flash') as $key => $item)
            <div class="alert alert-{{ $key }}">{{ session('flash.' . $key) }}</div>
        @endforeach
    @endif
    <div class="wrapper">
        @yield('sub')
        <div class="main-contents active">
        @yield('header')
        <main>
            @yield('content')
        </main>
        </div>
    </div>
    {{-- datepicker　動かない --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    {{-- datetimepicker --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

    <script src="{{ asset('js/admin/common.js') }}">
        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })

        $.datepicker.setDefaults({
        changeYear: true,
        changeMonth: true,
        });
    </script>
    @yield('pageJs')
    <script>
        window.onload = function () {
        $("body").show();
        };
    </script>
</body>
</html>
