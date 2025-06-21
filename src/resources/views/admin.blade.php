<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/common.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__inner-title">FashionablyLate</h1>
            <form class="form" method="POST" action="/logout">
                @csrf
                <button class="admin-logout__btn" type="submit">ログアウト</button>
            </form>
        </div>
    </header>
    <main>
        <div class="admin-form__heading">
            <h2>Admin</h2>
        </div>
        <form class="form" method="GET" action="/admin">
            <input type="text" name="admin-search_keyword" placeholder="名前やメールアドレスを入力" value="{{ request('admin-search_keyword') }}" />
            <select class="admin-search__gender" name="gender">
                <option value="">性別</option>
                <option value="1" {{ request("gender") == "1" ? "selected" : "" }}>男性</option>
                <option value="2" {{ request("gender") == "2" ? "selected" : "" }}>女性</option>
                <option value="3" {{ request("gender") == "3" ? "selected" : "" }}>その他</option>
            </select>
            <select class="admin-search__category" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request("category_id") == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            <input class="admin-search__date" type="date" name="date" value="{{ request('date') }}" />
            <button type="submit">検索</button>
            <a href="/admin">リセット</a>
        </form>

        <a href="/admin/export">エクスポート</a>

        <div class="admin-table">
            {{ $contacts->links() }} {{-- ページネーション --}}
            
            <table class="admin-table__inner">
                <tr class="admin-table__row">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__text">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td class="admin-table__text">
                        @if ($contact->gender == '1')
                        男性
                        @elseif ($contact->gender == '2')
                        女性
                        @else
                        その他
                        @endif
                    </td>
                    <td class="admin-table__text">{{ $contact->email }}</td>
                    <td class="admin-table__text">{{ $contact->category->content ?? '未設定' }}</td>
                    <td class="admin-table__text">
                        <button class="admin-btn_detail" data-id="{{ $contact->id }}"
                            data-name="{{ $contact->first_name }} {{ $contact->last_name }}"
                            data-gender="{{$contact->gender}}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{e($contact->tel)}}"
                            data-address="{{$contact->address}}"
                            data-building="{{$contact->building}}"
                            data-category_id="{{$contact->category->content ?? '未設定'}}"
                            data-detail="{{ $contact->detail }}">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
</body>

</html>


<!-- モーダル背景 -->
<div class="admin-modal">
    <!-- モーダル本体 -->
    <div class="admin-modal__body">
        <!-- 閉じるボタン -->
        <button class="admin-modal__close">&times;</button>

        <!-- 詳細内容 -->
        <div class="admin-modal__content">
            <!-- JSでここに詳細データを入れる -->
        </div>

        <!-- 削除ボタン -->
        <div class="admin-modal__delete">
            <form class="form" method="POST" action="/admin/delete">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="">
                <button type="submit" class="admin-modal__delete-btn">削除</button>
            </form>
        </div>
    </div>
</div>
<script>
    // 詳細ボタンをクリックしたとき
    document.querySelectorAll('.admin-btn_detail').forEach(button => {
        button.addEventListener('click', function() {
            // 各データを取得
            const name = this.dataset.name;
            const gender = this.dataset.gender;
            const genderLabel = {
                "1": "男性",
                "2": "女性",
            } [gender] ?? "その他";
            const email = this.dataset.email;
            const tel = this.dataset.tel;
            const address = this.dataset.address;
            const building = this.dataset.building;
            const category_id = this.dataset.category_id;
            const detail = this.dataset.detail;
            const id = this.dataset.id;
            document.querySelector('input[name="id"]').value = id;
            // モーダルの中にHTMLを挿入
            const content = `
        <p><strong>名前</strong> ${name} </p>
        <p><strong>性別</strong> ${genderLabel} </p>
        <p><strong>メールアドレス</strong> ${email}</p>
        <p><strong>電話番号</strong> ${tel} </p>
        <p><strong>住所</strong> ${address} </p>
        <p><strong>建物名</strong> ${building} </p>
        <p><strong>お問い合わせの種類</strong> ${category_id} </p>
        <p><strong>内容</strong><br>${detail}</p>`;
            document.querySelector('.admin-modal__content').innerHTML = content;


            // モーダル表示
            document.querySelector('.admin-modal').style.display = 'block';
        });
    });

    // 閉じるボタンで非表示に
    document.querySelector('.admin-modal__close').addEventListener('click', function() {
        document.querySelector('.admin-modal').style.display = 'none';
    });
</script>