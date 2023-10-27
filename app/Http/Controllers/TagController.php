<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create_tag(Request $request){
 
    return Tag::create([
        'tagName' => $request->tagName
    ]) ;


}
// end create_tag  





public function get_tag(){
    return Tag::orderBy('id','desc')->get() ;
}
// end get_tag


public function edit_tag(Request $request){
  
  return Tag::where('id', $request->id)->update([
    'tagName' => $request->tagName
  ]) ;

}
// end edit_tag

public function delete_tag(Request $request){

  
  return Tag::where('id', $request->id)->delete() ;

}
// end delete_tag


// CATEGORY 
public function uploadFile(Request $request){

  $picName = time().'.'.$request->file->extension();
 $request->file->move(public_path('uploads'),$picName);
return $picName;

}


public function delete_image(Request $request)
{
    $fileName = $request->imageName;
    $this->deleteFileFromServer($fileName, false);
    return 'done';
}
public function deleteFileFromServer($fileName, $hasFullPath = false)
{
    if (!$hasFullPath) {
        $filePath = public_path() . '/uploads/' . $fileName;
    }
    if (file_exists($filePath)) {
        @unlink($filePath);
    }
    return;
}







// end delete_iamge


public function create_category(Request $request){
 
  return Category::create([
      'categoryName' => $request->categoryName,
      'iconImage' => $request->iconImage
  ]) ;


}
// end create_category  

public function get_category(){
  return Category::orderBy('id','desc')->get() ;
}

public function edit_category(Request $request){
  
  return Category::where('id', $request->id)->update([
    'categoryName' => $request->categoryName,
    'iconImage' => $request->iconImage
  ]) ;

}
// end edit_category



// delete category file
public function delete_category(Request $request){
  $this->deleteFileFromServer($request->iconImage);
  return Category::where('id', $request->id)->delete() ;

}


public function createUser(Request $request)
{
    // validate request

    $password = bcrypt($request->password);
    $user = User::create([
        'fullname' => $request->fullname,
        'email' => $request->email,
        'password' => $password,
         'userType' => $request->userType
    ]);
    return $user;
}

public function getUsers()
{
    return User::get();
}



// end admin_index   fullname	email	password	userType	






// main end line
}
