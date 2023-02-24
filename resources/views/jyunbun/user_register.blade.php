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
                <h2 class="title">新規登録</h2>
                <form action="{{ url('/user_confirm') }}" method="post">
                @csrf
                    <h3 class="sub_title">新規登録することで作品掲載スペースが生まれます。</h3>

                    <dl class="posts_box_wrapper">
                        <dt>
                            <label for="name">ユーザーネーム</label>
                        </dt>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                        </dd>

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

                        <dt>
                            <label for="password">パスワード確認</label>
                        </dt>
                        @error('password_confirm')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="password" name="password_confirm" id="password_confirm" value="{{ old('password_confirm') }}">
                        </dd>

                        <dd class="submit_box">
                            <a href="{{ url('/login') }}">戻 る</a>
                            <button type="submit" name="submit_btn" id="submit_btn">確認ページへ</button>
                        </dd>
                    </dl>
                </form>
