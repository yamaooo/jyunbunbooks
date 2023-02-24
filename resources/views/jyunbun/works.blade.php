<!DOCTYPE html>
<html lang=ja>
    <head>
        <meta charset="UTF-8">
        <title>自作サイト</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://kit.fontawesome.com/c4d5cb8f26.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <header class="contact">
            <nav class="header">
                <div class="logo">
                    <a href="{{ url('/index') }}">
                        <h3>jyunbun books</h3>
                    </a>
                </div>

                <div class="search">
                    <form action="{{ url('/works') }}" method="GET">
                        <input type="text" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                        <input type="submit" value="検索">
                    </form>
                </div>
                
                <div class="nav_link">
                        <a href="{{ url('/login') }}">
                            <p>作品を掲載する</p>
                        </a>
                </div>
            </nav>
        </header>

        <h2 style="padding-left: 30px">作品リスト</h2>
        @foreach ($works as $work)
        <div class="posts_box works_view_box">
            <div class="posts_wrapper works_view_box_wrapper">
            @auth
                @if (Auth::user()->isLike($work->id))
                    <div class="likes_button">
                        <a class="toggle_like liked" postId="{{$work->id}}" like_val="1"><i class="fa-solid fa-heart"></i></a>
                    </div>
                @else
                    <div class="likes_button">
                        <a class="toggle_like like" postId="{{$work->id}}" like_val="0"><i class="fa-solid fa-heart"></i></a>
                    </div>
                @endif
            @endauth

                @if($work->image)
                    <div class="user_image works_image">
                        <img src="{{ asset('storage/image/' . $work->image) }}">
                    </div>
                    <br>
                @endif

                <header>
                    <h2 class="works_view_title">{{ $work->title }}</h2>
                </header>

                <p class="works_view_headline">{{ $work->headline }}</p>

                <ul class="works_view_format">
                    <li>{{ $work->format }}</li>
                </ul>

                <footer>
                    <div class="works_view_name">
                        {{ $work->name }} 作
                    </div>
                    <a href="{{ url('/works_detail', ['id'=>$work->id]) }}" class="works_detail_link">読む</a>
                </footer>
            </div>
        </div>
        @endforeach

        {{ $works->links('pagination::bootstrap-4') }}

        @include('jyunbun.footer')

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>