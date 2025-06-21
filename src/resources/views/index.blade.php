<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/common.css') }}" /> -->

</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__inner-title">FashionablyLate</h1>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>
            <form class="form" action="/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text name-inputs">
                            <input type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name', $input['first_name'] ?? '') }}" />
                            <input type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name', $input['last_name'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('first_name')
                            {{$message}}
                            @enderror
                            @error('last_name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input-radio">
                            <input type="radio" name="gender" value="1" checked>男性
                            <input type="radio" name="gender" value="2">女性
                            <input type="radio" name="gender" value="3">その他
                        </div>
                        <div class="form__error">
                            @error('gender')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email', $input['email'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1', $input['tel1'] ?? '') }}" />-
                            <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2', $input['tel2'] ?? '') }}" />-
                            <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3', $input['tel3'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('tel')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $input['address'] ?? '') }}" />
                        </div>
                        <div class="form__error">
                            @error('address')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', $input['building'] ?? '') }}" />
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--select">
                            <select name="category_id" id="category_id">
                                <option value="" disabled selected>選択してください</option>
                                <option value="1">商品の交換について</option>
                            </select>
                        </div>
                        <div class="form__error">
                            @error('category_id')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $input['detail'] ?? '') }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>