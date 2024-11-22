<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// Fashion Modelの使用を宣言
use App\Models\Fashion;

class FashionController extends Controller
{
    public function index(Request $request)
    {
        $headline = Fashion::orderBy('updated_at', 'desc')->first();
        if (!$headline) {
            $headline = null;
        }
    
        $posts = Fashion::orderBy('updated_at', 'desc')->paginate(9)->onEachSide(1);
        

        // fashion/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('fashion.index', ['headline' => $headline, 'posts' => $posts]);
    }

    //ホーム画面に検索機能をつける
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = [];
        
        if ($query) {
            
            $posts = Fashion::where('title', 'LIKE', "%{$query}%")
                            ->orWhere('body', 'LIKE', "%{$query}%")
                            ->orderBy('updated_at', 'desc')->paginate(9);
        }
        
        $headline = null;
        //dd($posts);
        return view('fashion.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
