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
                <h2 class="title">ご登録が完了しました</h2>

                <dd class="submit_box complete">
                <a href="{{ url('/login') }}">トップページへ</a>
            </dd>

            </div>
        </section>