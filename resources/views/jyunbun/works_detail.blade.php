<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>自作サイト</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <header class="contact">
            <nav class="header">
                <div class="logo">
                    @if(Auth::user())
                        <a href="javascript:history.back()">
                            <h3>jyunbun books</h3>
                        </a>
                    @else
                        <a href="{{ url('/works') }}">
                            <h3>jyunbun books</h3>
                        </a>
                    @endif
                </div>

                <div class="nav_link_works">
                        <a href="{{ url('/works') }}">
                            <p>作品リスト</p>
                        </a>
                </div>

                <div class="nav_link">
                        <a href="{{ url('/login') }}">
                            <p>作品を掲載する</p>
                        </a>
                </div>
            </nav>
        </header>

        <div class="detail_box">
            <div class="detail_box_wrapper">
                <div class="detail_title_box">
                    <h1>{{ $novel->title }}</h1>
                </div>

                <div class="detail_body_box">
                    <p>{!!  nl2br(e($novel->body)) !!}</p>
                </div>

                <div class="detail_title_footer_box">
                    <p>{{ $novel->title }}</p>
                </div>
            </div>
        </div>
    </body>
</html>