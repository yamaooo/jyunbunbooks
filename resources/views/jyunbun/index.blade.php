<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>自作サイト</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    @if(session('log_out'))
        <div class="alert alert-danger success">
            {{ session('log_out') }}
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <body>
        <div class="img_box">
            <img src="{{ asset('img/book_smile_boys.png') }}">
        </div>

        <div class="content_box">
            <div class="content_first">
                <a href="{{ url('/works') }}">作品を読む</a>
            </div>

            <div class="content_second">
                <a href="{{ url('/login') }}">作品を掲載する</a>
            </div>
        </div>
    </body>
</html>