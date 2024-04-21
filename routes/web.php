<?php

use App\Models\link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
    return view('url');
});
Route::post('/',function(Request $request) {
    $rules =array(
        'link'=>'required|url'
    );
    $validation = Validator::make($request -> all(), $rules);
    if ($validation ->fails()) {
        return Redirect::to('/')->witherrors($validation);
    }
    else{
        $link = link::where('url',$request->input('link'))->first();

        if($link){
            return Redirect::to('/')->with('link',$link->hash);
        }else{
            do{
                $newHash = Str::random(6);
            }while(Link::where('hash',$newHash)->count()>0);

            Link::create(array(
                'url'=>$request->input('link'),
                'hash'=>$newHash
            ));
            return Redirect::to('/')->with('link',$newHash);

        }
    }
});

Route::get('{hash}',function($hash){
    $link = Link::where('hash',$hash)->first();
    if($link){
        return Redirect::to($link->url);
    }else{
        return Redirect::to('/')->with('message','Invalid link');
    }
});
