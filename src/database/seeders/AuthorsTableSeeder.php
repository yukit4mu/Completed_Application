<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'tony',
            'age' => 35,
            'nationality' => 'American'
        ];
        DB::table('authors')->insert($param);
        $param = [
            'name' => 'jack',
            'age' => 20,
            'nationality' => 'British'
        ];
        //DB::table('authors'): DB は Laravel のファサードで、データベース操作に関連する静的メソッドへのアクセスを提供します。table メソッドは、指定されたテーブル名（この場合は 'authors'）のクエリビルダを生成します。クエリビルダは、SQL クエリを構築するためのメソッドを提供します。

        // ->insert($param): 生成されたクエリビルダに対して insert メソッドが呼び出されています。これはデータベースに新しいレコードを挿入するためのメソッドです。引数としては、挿入するデータが格納された連想配列（この場合は $param）を取ります。

        //結局、この一連のコードは、authors テーブルに $param で指定されたデータを挿入するためのデータベース操作を行っています。insert メソッドは一度に一つのレコードを挿入するのではなく、与えられた連想配列のデータを使って一括で挿入することができます。

        //"->" は、オブジェクト指向プログラミングにおいて、オブジェクトやクラスのメソッドやプロパティにアクセスするために使われる演算子です。
        //具体的には、$variable->method() などといった形で使われ、$variable がオブジェクトである場合にそのオブジェクトのメソッドにアクセスすることを意味します。
        DB::table('authors')->insert($param);
        $param = [
            'name' => 'sara',
            'age' => 45,
            'nationality' => 'Egyptian'
        ];
        DB::table('authors')->insert($param);
        $param = [
            'name' => 'saly',
            'age' => 31,
            'nationality' => 'Chinese'
        ];
        DB::table('authors')->insert($param);
    }
}
