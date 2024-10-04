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
}
