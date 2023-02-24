<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>自作サイト</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://kit.fontawesome.com/c4d5cb8f26.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="contact">
            <nav class="header">
                <div class="logo">
                    <a href="{{ url('/mypage') }}">
                        <h3>jyunbun books</h3>
                    </a>
                </div>

                <div class="nav_link_works">
                        <a href="{{ url('/works') }}">
                            <p>作品リスト</p>
                        </a>
                </div>

                <div class="nav_link">
                        <a href="{{ route('logout') }}">
                            <p>ログアウト</p>
                        </a>
                </div>
            </nav>
        </header>

        @if(session('user_edit'))
            <div class="alert alert-danger success">
                {{ session('user_edit') }}
            </div>
        @endif

        @if(session('works_register'))
            <div class="alert alert-danger success">
                {{ session('works_register') }}
            </div>
        @endif

        @if(session('works_update'))
            <div class="alert alert-danger success">
                {{ session('works_update') }}
            </div>
        @endif

        @if(session('works_delete'))
            <div class="alert alert-danger success">
                {{ session('works_delete') }}
            </div>
        @endif

        <h2 style="padding-left: 30px">{{ Auth::user()->name }}さんのマイページ</h2>

        <div class="posts_box mypage_box">
            <div class="posts_box_wrapper">
                <h3>プロフィール</h3>
                @if(Auth::user()->image)
                    <div class="user_image">
                        <img src="{{ asset('storage/image/' . Auth::user()->image) }}">
                    </div>
                    <br>
                @endif
                <a href="{{ url('/user_edit') }}">プロフィール編集</a>
            </div>
        </div>

        <div class="posts_box mypage_box">
            <div class="posts_box_wrapper">
                <div class="works_register_icon">
                    <a class="fa-solid fa-plus" href="{{ url('works_register') }}"></a>
                </div>
                <h3 style="margin-top: 0">作品管理</h3>
                <a href="{{ url('/works_user') }}">作品一覧</a><br>
                @can('system-only')
                <div style="margin-top: 15px">
                    <a href="{{ url('/admin_works') }}">会員ユーザー作品一覧</a>
                </div>
                @endcan
            </div>
        </div>

        <div class="posts_box mypage_box">
            <div class="posts_box_wrapper">
                <h3>いいね</h3>
                <a href="{{ url('/works_like') }}">いいね一覧</a>
            </div>
        </div>
        
        @include('jyunbun.footer')

    </body>
</html>