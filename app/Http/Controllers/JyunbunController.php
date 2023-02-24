<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\WorksRegisterRequest;
use App\Http\Requests\WorksEditRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class JyunbunController extends Controller
{
    public function index() 
    {
        return view('Jyunbun.index');
        
    }

    public function user_register(UserRegisterRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirm = $request->input('password_confirm');

        return view('Jyunbun.user_confirm', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirm' => $password_confirm,
        ]);
    }

    public function user_complete(Request $request)
    {
        $password = Hash::make($request->input('password'));

        $user = new user;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $password;;
        $user->save();

        return view('Jyunbun.user_complete');
    }

    public function mypage(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password', 'role');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('mypage');
        }

        return back()->with('login_error', 'ユーザーが存在しません');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('index')->with('log_out', 'ログアウトしました');
    }

    public function logincheck()
    {
        if (Auth::check()) {
            return view('jyunbun.mypage');
          } else {
            return view('jyunbun.login');
          }
    }

    public function user_edit(UserEditRequest $request)
    {
        $user = Auth::user();

        if($request->file('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image', $image);
        
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->image = $image;
            $user->save();
        }else {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
        }

        return redirect('mypage')->with('user_edit', 'プロフィール情報の更新が完了しました');
    }

    public function novels_format()
    {
        $novels_formats = DB::table('novels_format')->get();
        return view('jyunbun.works_register', ['novels_formats' => $novels_formats]);
    }

    public function works_register(WorksRegisterRequest $request)
    {
        $user_id = Auth::id();

        if($request->file('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image', $image);

            $novel = new novel;
            $novel->title = $request->input('title');
            $novel->headline = $request->input('headline');
            $novel->format_id = $request->input('format');
            $novel->body = $request->input('body');
            $novel->published = $request->input('published');
            $novel->user_id = $user_id;
            $novel->image = $image;
            $novel->save();
        }else {
            $novel = new novel;
            $novel->title = $request->input('title');
            $novel->headline = $request->input('headline');
            $novel->format_id = $request->input('format');
            $novel->body = $request->input('body');
            $novel->published = $request->input('published');
            $novel->user_id = $user_id;
            $novel->save();
        }

        return redirect('mypage')->with('works_register', '作品の登録が完了しました');
    }

    public function works(Request $request)
    {
        $keyword = $request->input('keyword');

        if(!empty($keyword)) {
        $works = DB::table('novels')->select(
            'novels.id',
            'novels.image',
            'novels.title',
            'novels.headline',
            'novels_format.format',
            'users.name',
        )
        ->from('novels')
        ->join('novels_format', 'novels.format_id', '=', 'novels_format.id')
        ->join('users', 'novels.user_id', '=', 'users.id')
        ->where(function ($query) use ($keyword) {$query->where("novels.title", "like", "%".$keyword."%")->orWhere("users.name", "like", "%".$keyword."%");})->where('novels.published', 0)->where('novels.del_flg', 0)->orderBy('novels.id', 'desc')->paginate(3);
        }else {
            $works = DB::table('novels')->select(
                'novels.id',
                'novels.image',
                'novels.title',
                'novels.headline',
                'novels_format.format',
                'users.name',
            )
            ->from('novels')
            ->join('novels_format', 'novels.format_id', '=', 'novels_format.id')
            ->join('users', 'novels.user_id', '=', 'users.id')
            ->where('novels.published', 0)->where('novels.del_flg', 0)->orderBy('novels.id', 'desc')->paginate(3);
        }

        return view('jyunbun.works', ['works' => $works], compact('keyword'));
    }

    public function works_user()
    {
        $user_id = Auth::id();

        $works = DB::table('novels')->select(
            'novels.id',
            'novels.image',
            'novels.title',
            'novels.headline',
            'novels_format.format',
            'users.name',
        )
        ->from('novels')
        ->join('novels_format', 'novels.format_id', '=', 'novels_format.id')
        ->join('users', 'novels.user_id', '=', 'users.id')
        ->where('novels.user_id', $user_id)->where('novels.del_flg', 0)->orderBy('novels.id', 'desc')->paginate(3);
        return view('jyunbun.works_user', ['works' => $works]);
    }

    public function works_edit($id)
    {
        $novel = Novel::findOrFail($id);
        $novels_formats = DB::table('novels_format')->get();

        return view('jyunbun.works_edit', compact('novel'), ['novels_formats' => $novels_formats]);
    }

    public function works_update(WorksEditRequest $request, $id)
    {
        $novel = Novel::findOrFail($id);

        if($request->file('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image', $image);

            $novel->title = $request->input('title');
            $novel->headline = $request->input('headline');
            $novel->format_id = $request->input('format');
            $novel->body = $request->input('body');
            $novel->published = $request->input('published');
            $novel->image = $image;
            $novel->save();
        }else {
            $novel->title = $request->input('title');
            $novel->headline = $request->input('headline');
            $novel->format_id = $request->input('format');
            $novel->body = $request->input('body');
            $novel->published = $request->input('published');
            $novel->save();
        }

        return redirect('mypage')->with('works_update', '作品の更新が完了しました');
    }

    public function works_delete($id)
    {
        $novel = Novel::findOrFail($id);
        $novel->del_flg = 1;
        $novel->save();

        return redirect('mypage')->with('works_delete', '作品の削除が完了しました');

    }

    public function works_detail($id)
    {
        $novel = Novel::findOrFail($id);

        return view('jyunbun.works_detail', compact('novel'));

    }

    public function admin_works()
    {
        $works = DB::table('novels')->select(
            'novels.id',
            'novels.image',
            'novels.title',
            'novels.headline',
            'novels_format.format',
            'users.name',
        )
        ->from('novels')
        ->join('novels_format', 'novels.format_id', '=', 'novels_format.id')
        ->join('users', 'novels.user_id', '=', 'users.id')
        ->orderBy('novels.id', 'desc')->paginate(3);
        
        return view('jyunbun.admin_works', ['works' => $works]);

    }

    public function works_like()
    {
        $user_id = Auth::id();

        $works = DB::table('novels')->select(
            'novels.id',
            'novels.image',
            'novels.title',
            'novels.headline',
            'novels_format.format',
            'users.name',
        )
        ->from('novels')
        ->join('novels_format', 'novels.format_id', '=', 'novels_format.id')
        ->join('users', 'novels.user_id', '=', 'users.id')
        ->join('likes', 'novels.id', '=', 'likes.novel_id')
        ->where('likes.user_id', $user_id)->where('novels.published', 0)->where('novels.del_flg', 0)->orderBy('novels.id', 'desc')->paginate(3);
        return view('jyunbun.works_like', ['works' => $works]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('headline', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('jyunbun.works', compact('posts', 'keyword'));
    }
}
