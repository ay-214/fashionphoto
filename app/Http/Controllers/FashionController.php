<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Fashion Modelの使用を宣言
use App\Models\Fashion;

class FashionController extends Controller
{
    public function index(Request $request)
    {
        $posts = Fashion::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // fashion/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('fashion.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
