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

        <div class="posts_box works_register_box">
            <h2 class="title">作品登録</h2>
            <form action="{{ route('works_register') }}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="posts_wrapper works_register_wrapper">
                    <div class="works_box_first">
                        <div class= "works_image_box">
                            <dt>
                                <label for="image">サムネイル画像</label>
                            </dt>

                            <dd>
                                <input type="file" name="image" id="image">
                            </dd>
                        </div>

                        <div class="title_box">
                            <dt>
                                <label for="title">作品名</label>
                            </dt>
                            @error('title')
                                <div class="alert alert-danger works_register_danger">{{ $message }}</div>
                            @enderror
                            <dd>
                                <input type="title" name="title" id="title" maxlength="50" value="{{ old('title') }}">
                            </dd>
                            <p>必須 50文字以内でご入力ください</p>

                            <dt>
                                <label for="headline">見出し</label>
                            </dt>
                            @error('headline')
                                <div class="alert alert-danger works_register_danger">{{ $message }}</div>
                            @enderror
                            <dd>
                                <input type="headline" name="headline" id="headline" maxlength="50" value="{{ old('headline') }}">
                            </dd>
                            <p>50文字以内でご入力ください</p>

                            <dt>
                                <label for="format">形式</label>
                            </dt>

                            <select name="format" id="format">
                            @foreach ($novels_formats as $novels_format)
                                <option value="{{ $novels_format->id }}">{{ $novels_format->format }}</option>
                            @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="body_box">
                        <dt>
                            <label for="body">本文</label>
                        </dt>
                        @error('body')
                            <div class="alert alert-danger works_register_danger">{{ $message }}</div>
                        @enderror
                        <dd>
                            <textarea name="body" id="body" maxlength="200000">{{ old('body') }}</textarea>
                        </dd>
                        <p>必須 200,000文字以内でご入力ください</p>
                    </div>

                    <div class="published_box">
                        <input type="radio" name="published" value="0" required checked style="width: 15px">公開する<br>
                        <input type="radio" name="published" value="1" style="width: 15px">非公開にする
                    </div>

                    <dd class="submit_box">
                        <a href="{{ url('/mypage') }}">戻 る</a>
                        <button type="submit" name="submit_btn" id="submit_btn" onclick="return confirm('この内容でご登録いたしますか？')">作品登録</button>
                    </dd>
            </form>
        </div>
    </body>
</html>