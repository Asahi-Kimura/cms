@section('header')
<header class="global-header">
    <div class="header-inner">
        <div class="header-left">
            <div class="sp-humberger_ar">
                <div class="humberger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="user-info">
            <p class="user-name">{{Auth::user()->name}}:  <a  href="#logout">ログアウト</a></p>
        </div>
        
        <div id="logout" class="plofile_ar">
            <form class="" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</header>
@endsection
