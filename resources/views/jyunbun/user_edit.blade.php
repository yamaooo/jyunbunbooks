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

                <div class="nav_link">
                        <a href="{{ route('logout') }}">
                            <p>ログアウト</p>
                        </a>
                </div>
            </nav>
        </header>

        <h2 style="padding-left: 30px">{{ Auth::user()->name }}さんのマイページ</h2>

        <div class="posts_box">
                <h2 class="title">プロフィール情報の編集</h2>
                <form action="{{ route('user_edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <dl class="posts_box_wrapper">
                        @if(Auth::user()->image)
                            <div class="user_image">
                                <img src="{{ asset('storage/image/' . Auth::user()->image) }}">
                            </div>
                            <br>
                        @endif

                        <dt>
                            <label for="image">プロフィール画像</label>
                        </dt>

                        <dd>
                            <input type="file" name="image" id="image">
                        </dd>

                        <dt>
                            <label for="name">ユーザーネーム</label>
                        </dt>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="name" name="name" id="name" value="{{ Auth::user()->name }}">
                        </dd>

                        <dt>
                            <label for="email">メールアドレス</label>
                        </dt>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">
                        </dd>

                        <dd class="submit_box">
                            <a href="{{ url('/mypage') }}">戻 る</a>
                            <button type="submit" name="submit_btn" id="submit_btn" onclick="return confirm('この内容で更新いたしますか？')">更 新</button>
                        </dd>
                    </dl>
                </form>

    </body>
</html>
