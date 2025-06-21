<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        return view('index', ['input' => $input]);
    }
// 確認画面
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'address',
            'tel',
            'building',
            'email',
            'detail',
            'gender',
            'category_id',
        ]);
        $contact['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        $contact['tel1'] = $request->input('tel1');
        $contact['tel2'] = $request->input('tel2');
        $contact['tel3'] = $request->input('tel3');
        $categoryTypes = [
            1 => '商品の交換について'
        ];
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        return view('confirm', compact('contact','categoryTypes', 'genderLabels'));
    }
// データの保存
    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'address',
            'tel',
            'building',
            'email',
            'detail',
            'gender',
            'category_id',
        ]);
        $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        $contact['tel'] = $tel;

        Contact::create($contact);
        return redirect('/thanks');
    }
    public function fix(Request $request)
    {
        // $input = $request->all(); // hiddenの内容を全取得
        // return view('index', compact('input'));
        return redirect('/')
            ->withInput($request->all());
    }
}
