<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/common.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__inner-title">FashionablyLate</h1>
            <div class="login__link">
                <a class="login__button-submit" href="/login">login</a>
            </div>
        </div>
    </header>
    <main>
        <div class="register-form__heading">
            <h2>Register</h2>
        </div>
        <div class="register-form__content">
            <div class="register-form__inner">
                <form class="form" action="/register" method="post">
                    @csrf
                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">お名前</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="text" name="name" value="{{ old('name') }}" />
                            </div>
                            <div class="form__error">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">メールアドレス</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="email" name="email" value="{{ old('email') }}" />
                            </div>
                            <div class="form__error">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">パスワード</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="password" name="password" />
                            </div>
                            <div class="form__error">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form__button">
                        <button class="form__button-submit" type="submit">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>