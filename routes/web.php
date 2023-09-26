<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* my test */
/*prefix /blog*/
Route::prefix('/blog')->group(function(){
/* Route::prefix('/blog')->name('blog.')->group(function(){ */ /* prefix nom des route */
    /* Simple route use a url param */
    Route::get('/', function(Request $request){
        return [
            "path" => $request->path(),
            "name" => $request->input('name', "john doe"),
            "article"=>'art1'
        ];
    })->name('blog.index');  /* name of route */

    /* Simple route with slug et id*/
    Route::get('/{slug}-{id}', function(string $slug, string $id){
        return [
            "slug" => $slug,
            "id" => $id,
            "article"=>'art1',
            "link"=> \route('blog.show', ['slug'=>"art1", 'id'=> 14])
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-zA-Z0-9\-]+'
    ])->name('blog.show');

});
