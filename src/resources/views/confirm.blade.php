<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('css/common.css') }}" /> -->
</head>

<header class="header">
    <div class="header__inner">
        <h1 class="header__inner-title">FashionablyLate</h1>
    </div>
</header>

<main>
    <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>
        <div class="confirm-table">
            <form class="form" id="sendForm" action="/contacts" method="post">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" name="first_name" value="{{ $contact['first_name'] }}" />
                            <input type="text" name="last_name" value="{{ $contact['last_name'] }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            {{ $genderLabels[$contact['gender']] ?? '未選択' }}
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="email" name="email" value="{{ $contact['email'] }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            <input type="tel" name="tel1" value="{{ $contact['tel1'] }}" />
                            <input type="tel" name="tel2" value="{{ $contact['tel2'] }}" />
                            <input type="tel" name="tel3" value="{{ $contact['tel3'] }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{$contact['address']}}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building" value="{{$contact['building']}}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            {{ $categoryTypes[$contact['category_id']] ?? '未選択' }}
                            <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" name="detail" value="{{$contact['detail']}}" />
                        </td>
                    </tr>
                </table>
            </form>
            <form class="form" id="fixForm" action="/fix" method="post">
                @csrf
                @foreach($contact as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$value}}">
                @endforeach
            </form>
            <div class="form__button-area">
                <button class="form__button-submit" type="submit" form="sendForm">送信</button>
                <button class="form__button-submit" type="submit" form="fixForm">修正</button>
            </div>
        </div>
    </div>
</main>
</body>


</html>