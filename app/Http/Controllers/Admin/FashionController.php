<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Fashion Modelが扱えるように以下の一文を追加
use App\Models\Fashion;

class FashionController extends Controller
{
    //add actionを追加
    public function add()
    {
        return view('admin.fashion.create');
    }

     //admin/fashion/createにリダイレクトする設定を追加
     public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Fashion::$rules);

        $fashion = new Fashion;
        $form = $request->all();

         // フォームから画像が送信されてきたら、保存して、$fashion->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $fashion->image_path = basename($path);
        } else {
            $fashion->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $fashion->fill($form);
        $fashion->save();

        return redirect('admin/fashion/create');
    }

    // index Actionを追加
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Fashion::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Fashion::all();
        }
        return view('admin.fashion.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    //edit Actionを追記
    public function edit(Request $request)
    {
        // Fashion Modelからデータを取得する
        $fashion = Fashion::find($request->id);
        if (empty($fashion)) {
            abort(404);
        }
        return view('admin.fashion.edit', ['fashion_form' => $fashion]);
    }

    //update Actionを追記
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Fashion::$rules);
        // Fashion Modelからデータを取得する
        $fashion = Fashion::find($request->id);
        // 送信されてきたフォームデータを格納する
        $fashion_form = $request->all();

        if ($request->remove == 'true') {
            $fashion_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $fashion_form['image_path'] = basename($path);
        } else {
            $fashion_form['image_path'] = $fashion->image_path;
        }

        unset($fashion_form['image']);
        unset($fashion_form['remove']);
        unset($fashion_form['_token']);

        // 該当するデータを上書きして保存する
        $fashion->fill($fashion_form)->save();

        return redirect('admin/fashion');
    }
}



