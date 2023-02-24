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
                <h2 class="title">ご登録内容のご確認</h2>
                <form action="{{ url('/user_complete') }}" method="post">
                @csrf
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="password" value="{{ $password }}">

                <h3 class="sub_title">以下の内容でご登録いたします。</h3>

                    <dl class="posts_box_wrapper confirm_wrapper">
                        <dt>氏名</dt>
                        <div>{{ $name }}</div>

                        <dt>メールアドレス</dt>
                        <div>{{ $email }}</div>

                        <dt>パスワード</dt>
                        <div>
                        <?php 
                            for($i = 0; $i < mb_strlen( $password ); $i++){
                            echo "●";
                            } 
                        ?>
                        </div>

                        <dt>パスワード確認</dt>
                        <div>
                        <?php 
                            for($i = 0; $i < mb_strlen( $password_confirm ); $i++){
                            echo "●";
                            } 
                        ?>
                        </div>

                        <dd class="submit_box">
                            <a href="{{ url('/user_register') }}">戻 る</a>
                            <button type="submit" name="submit_btn" id="submit_btn">新規登録</button>
                        </dd>
                    </dl>
                </form>
            </div>
        </section>
