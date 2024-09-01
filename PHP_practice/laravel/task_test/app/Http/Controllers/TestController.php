<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
  public function index()
  {
    // Eloquent(エロクアント)
    $values = Test::all();

    $count = Test::count();   //collection型でなく,数値の場合も
    $first = Test::findOrFail(1);
    $whereBBB = Test::where('text', '=', 'hello')->get();   //->get() 型を修正

    // クエリビルダ
    $queryBuilder = DB::table('tests')->where('text','=','hello')
    ->select('id','text')
    ->get();    //collection型に
    // ->first();    //値のみ

    dd($values, $count, $first, $whereBBB, $queryBuilder);   //処理を中断し,確認
    return view('tests/test', compact('values'));
  }
}
