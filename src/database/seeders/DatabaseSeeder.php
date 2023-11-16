<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Person;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthorsTableSeeder::class);
        // このコードは、AuthorsTableSeeder クラスを呼び出しています。call メソッドは、指定されたシーダークラスを実行します。シーダークラスはデータベースに初期データを挿入するための処理を定義します。

        //具体的には、AuthorsTableSeeder クラスの run メソッドが実行され、その中でデータベースの初期データ挿入が行われます。DatabaseSeeder クラスは通常、アプリケーション全体のデータベース初期化を担当し、複数のシーダークラスを呼び出すことがあります。

        //また、$this は、オブジェクト内でそのオブジェクト自体を指す特殊なキーワードです。クラス内のメソッドからクラスのプロパティやメソッドにアクセスするために使います。

        //$this->call(AuthorsTableSeeder::class); は、DatabaseSeeder クラス内で call メソッドを呼び出しています。$this は DatabaseSeeder クラス自体を指し、その中で call メソッドが呼ばれています。これにより、AuthorsTableSeeder クラスが実行され、データベースに初期データが挿入される流れが生まれます。
    }
}
