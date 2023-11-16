<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
// まず、use ステートメントがあります。これは、App\Models ネームスペース内の Author モデルを使うための宣言です。（AuthorControllerとAuthorモデルを連携させるイメージ）

class AuthorController extends Controller
{
    public function index()
    {
        //index メソッドは、HTTP GETリクエストが送信されたときに呼び出されるアクションメソッドです。(postはstoreメソッドに入れるみたい。。)
        $authors = Author::all();
        return view('index', ['authors' => $authors]);
        //またAuthor::all() は、Author モデルに対して呼び出される all メソッドであり、これは authors テーブルから全てのレコードを取得します。取得した著者のデータは、$authors 変数に格納されています。

        //Author::all() を使用すると、authors テーブル内の全ての著者の情報が含まれたコレクション（Laravelのコレクションクラスのインスタンス）が得られます。コレクションは、配列と同様にデータを扱うことができるが、より多くの便利なメソッドを提供します。これをビューに渡して、表示や処理に利用できます。

        //その後、return view('index', ['authors' => $authors]); の部分では、indexビューにデータを渡しながら表示している。このデータはindexビュー内で使用できるようになります。
        //具体的には、['authors' => $authors] はindexビューに authors という変数を使って $authors の値を渡しています。
        //'authors': これはビュー内で使用できる変数の名前です。ビュー内では $authors としてアクセスできます。
        //$authors: これはビューに渡されるデータです。具体的には、Author モデルから取得されたデータのコレクションです。
    }
}
