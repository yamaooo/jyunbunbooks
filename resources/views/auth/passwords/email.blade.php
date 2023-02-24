
<!-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->

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

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif


        <section>
            <div class="posts_box">
                <h2 class="title">パスワードリセット</h2>
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                    <h3 class="sub_title">パスワードをリセットします。ご登録済みのメールアドレスをご入力ください。</h3>

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

                        <dd class="submit_box">
                            <a href="{{ url('/login') }}">戻 る</a>
                            <button type="submit" name="submit_btn" id="submit_btn">送 信</button>
                        </dd>
                    </dl>
                </form>
            </div>
        </section>
    </body>
</html>
