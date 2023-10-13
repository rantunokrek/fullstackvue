<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create_tag(Request $request){
    return Tag::create([
        'tagName' => $request->tagName
    ]) ;


}  

public function get_tag(){
    return Tag::orderBy('id','desc')->get() ;
}





}
