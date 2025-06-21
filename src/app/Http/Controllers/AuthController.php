<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;



class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function registerStore(AuthRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::logout();
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    public function login()
    {
        return view('login');
    }
    public function loginStore(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ]);
    }
    public function admin(Request $request)
    {
        $query = Contact::query()->with('category');

        //  キーワード検索（姓、名、フルネーム、メール）
        if ($request->filled('admin-search_keyword')) {
            $keyword = $request->input('admin-search_keyword');
            $searchTerm = "%{$keyword}%";

            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'like', $searchTerm)
                    ->orWhere('last_name', 'like', $searchTerm)
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", [$searchTerm])
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        // 性別検索
        if ($request->filled('gender')) {
            $gender = (int) $request->input('gender');
            $query->where('gender', $gender);
        }
        // カテゴリ検索
        if ($request->filled('category_id')) {
            $categoryId = (int) $request->input('category_id');
            $query->where('category_id', $categoryId);
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }
        Log::info('検索条件', $request->all());
        $contacts = $query->paginate(7)->appends($request->all());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
    public function delete(Request $request)
    {
        $id = $request->input('id');

        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return redirect('/admin');
        } else {
            return redirect('/admin')->with('error', '削除対象が見つかりませんでした');
        }
    }
}
