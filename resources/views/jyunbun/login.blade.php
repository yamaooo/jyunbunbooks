<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>自作サイト</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <header class="contact">
            <nav class="header">
                <div class="logo">
                    <a href="{{ url('/index') }}">
                        <h3>jyunbun books</h3>
                    </a>
                </div>

                <div class="nav_link">
                        <a href="{{ url('/works') }}">
                            <p>作品リスト</p>
                        </a>
                </div>
            </nav>
        </header>

        <section>
            <div class="posts_box">
                <h2 class="title">ログイン</h2>
                <form action="{{ route('mypage') }}" method="post">
                @csrf
                <input type="hidden" name="role" value="0">
                    <h3 class="sub_title">会員の方は、ログインすることで作品を掲載できます。</h3>

                    @if(session('login_error'))
                        <div class="alert alert-danger alert-error" style="text-align: center; padding: 0">
                            {{ session('login_error') }}
                        </div>
                    @endif

                    <dl class="posts_box_wrapper">
                        <dt>
                            <label for="email">メールアドレス</label>
                        </dt>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="text" name="email" id="email" value="{{ old('email') }}">
                        </dd>

                        <dt>
                            <label for="password">パスワード</label>
                        </dt>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="password" name="password" id="password" value="{{ old('password') }}">
                        </dd>

                        <dd>
                            <button type="submit" name="submit_btn" id="submit_btn">ログイン</button>
                        </dd>
                    </dl>
                </form>

                <div class="password_reset">
                    <a href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
                </div>

                <div class="admin_login">
                    <a href="{{ url('/admin_login') }}">管理者ログインはこちら</a>
                </div>

                <div class="user_register">
                    <a href="{{ url('/user_register') }}">新規登録</a>
                </div>
            </div>
        </section>
    </body>
</html>