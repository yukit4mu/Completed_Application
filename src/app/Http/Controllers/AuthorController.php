<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
// まず、use ステートメントがあります。これは、App\Models ネームスペース内の Author モデルを使うための宣言です。（AuthorControllerとAuthorモデルを連携させるイメージ）
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    // ↓データ一覧ページの表示
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
    // ↓データ追加用ページの表示
    public function add()
    {
        return view('add');
    }

    // ↓データ追加機能
    public function create(AuthorRequest $request)
    {
        $form = $request->all();
        Author::create($form);
        return redirect('/');
    }
    //Parameter (`Request $request):
    //メソッドの引数として $request が指定されています。これは、Laravelが提供する Request クラスのインスタンスで、HTTPリクエストに関する情報を取得するためのものです。メソッド内でこの $request を使用することで、クライアントが送信したデータやリクエストの詳細情報にアクセスできます。
    //$form = $request->all(); の部分では、HTTPリクエストからのデータを取得して変数 $form に代入しています。
    //$request->all():
    //これは Request インスタンスのメソッドで、$request インスタンスの all メソッドを呼び出しています。HTTPリクエストに含まれるすべてのデータを連想配列として取得します。formタグ内のinputタグのname属性がkey、inputタグに入力された値がvalueとして連想配列となって送信されます。
    //Author::create($form); は、LaravelのEloquent ORMを使用してデータベースに新しいレコードを作成するためのコードです。
    //Author::create：
    //Author モデルの create メソッドを呼び出しています。このメソッドは、Eloquentモデルを使用して新しいレコードをデータベースに挿入するためのシンプルな方法を提供します。
    //$form：
    //これは、先程の $request->all() で取得したリクエストデータ（フォームデータなど）を表します。通常、連想配列としてフォームからのデータが格納されています。
    //これにより、Author::create($form); は新しい Author レコードをデータベースに挿入します。Eloquentは $form のキーと値をモデルの属性として解釈し、対応するデータベースのカラムに値をセットします。
    //「データ追加用ページ」のinputタグのname属性がテーブルのカラム名と一致しているため、
    //createメソッドの引数にrequest->all()の値を代入することで、そのままテーブルに保存することができます。
    //つまり、bladeファイル内のinputタグのname属性がテーブルのカラム名と一致していれば、createメソッドの引数にrequest->all()の値を代入することで、そのままテーブルに保存することができます。

    // ↓データ編集ページの表示。基本的にidを元に更新するデータを取得します。
    public function edit(Request $request) //HTTPリクエストを受け取るために $request パラメータを使用しています。(HTTPリクエストをもとに処理する時の作法！)
    {
        // ↓指定された id に対応する Author モデルのデータを取得
        $author = Author::find($request->id);
        //$request->id はHTTPリクエストから送信された id パラメータを取得します。これは一般的にURLの一部として送信されます。
        //find メソッドは、LaravelのEloquent ORM（Object-Relational Mapping）で提供されるメソッドの一つで、データベースから特定の主キーに一致するレコードを取得するために使用されます。
        //Author::find($request->id) は、Eloquentを使用して Author モデルから指定された id に一致するデータをデータベースから取得します。このデータは $author 変数に格納されます。

        // ↓'edit' ビューに $author データを渡して表示
        return view('edit', ['form' => $author]);
        //['form' => $author] は、'edit' ビューに渡されるデータを表しています。'form' はビュー内で使用できる変数の名前で、$author は取得した Author モデルのデータです。これにより、ビュー内で $form としてこのデータにアクセスできます。

        //つまりこのコードは指定された id の Author モデルデータを取得し、それを 'edit' ビューに渡して表示するためのアクションです。
    }

    //↓このアクションは、フォームから送信されたデータを使って Author モデルのレコードを更新し、最終的にはトップページにリダイレクトするものです。
    public function update(Request $request)
    {
        $form = $request->all(); //フォームのデータ全部取ってきて変数入れる
        unset($form['_token']);
        //CSRF（Cross-Site Request Forgery）トークンはフォームのセキュリティを向上させるためのもので、通常、フォーム送信時に含まれます。しかし、データベースに保存する必要はないので、unset 関数を使用して $form から除外します
        Author::find($request->id)->update($form);
        //Author::find($request->id)->update($form);:
        //Author::find($request->id) で指定された id に対応する元データを取得します。
        //取得してきた元データにアクセスして update($form) を呼び出し、フォームから送信されたデータでモデルを更新します。Eloquent は自動的に主キーを用いて対象のレコードを特定し、指定されたデータで更新します。
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        return view('delete', ['author' => $author]);
    }
    public function remove(Request $request)
    {
        Author::find($request->id)->delete();
        return redirect('/');
    }
    public function find()
    {
        return view('find', ['input' => '']);
    }
    public function search(Request $request)
    {
        $item = Author::where('name', 'LIKE', "%{$request->input}%")->first();
        // $item = Author::where('name', $request->input)->first();
        $param = [
            'input' => $request->input,
            'item' => $item
        ];
        return view('find', $param);
    }
    public function bind(Author $author)
    {
        $data = [
            'item' => $author,
        ];
        return view('author.binds', $data);
    }
    public function verror()//今更だけど黄色が自作メソッドで青が用意されてるメソッドか
    {
        return view('verror');
    }
    
}
