@section('sub')
<div class="side-contents">
    <div class="side-inner">
        <div class="humberger_ar">
            <div class="humberger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="side-nav">
            <ul class="main-category">
                <li>
                    <h4>
                        <a href="{{ route('home') }}">
                            <figure><i class="fas fa-home"></i></figure>
                            <p>HOME</p>
                        </a>
                    </h4>
                </li>
                <li>
                    <h4>
                        <a href="{{ route('user')}}">
                            <figure><i class="fas fa-mail-bulk"></i></figure>
                            <p>会員登録</p>
                        </a>
                    </h4>
                </li>
                <li>
                    <h4>
                        <a href="{{ route('admin_contact')}}">
                            <figure><i class="fas fa-mail-bulk"></i></figure>
                            <p>お問い合わせ一覧</p>
                        </a>
                    </h4>
                </li>
                <li>
                    <h4>
                        <a href="{{ route('admin_news') }}">
                            <figure><i class="fas fa-mail-bulk"></i></figure>
                            <p>新着情報</p>
                        </a>
                    </h4>
                </li>
            </ul>
            @yield('pageNav')
        </nav>
    </div>
</div>
@endsection
