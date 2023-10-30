<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
  public function index(Request $request)
  {

      // first check if you are loggedin and admin user ...
      //return Auth::check();

      if (!Auth::check() && $request->path() != 'login') {
          return redirect('/login');
      }

      if (!Auth::check() && $request->path() == 'login') {

          return view('welcome');
      }
      // you are already logged in... so check for if you are an admin user..
      $user = Auth::user();
      if ($user->userType == 'User') {
          return redirect('/login');
      }
      if ($request->path() == 'login') {
          return redirect('/');
      }
      return view('welcome');

    
  }
  public function logout(Request $request){
     Auth::logout();
     return redirect('/login');
  }





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
    $this->validate($request, [
        'fullname' => 'required',
        'email' => 'bail|required|email|unique:users',
        'password' => 'bail|required|min:6',
       
    ]);
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


public function editUser(Request $request)
{
    // validate request
    $this->validate($request, [
        'fullname' => 'required',
        'email' => "bail|required|email|unique:users,email,$request->id",
        'password' => 'min:6',
        'userType' => 'required',
    ]);
    $data = [
        'fullname' => $request->fullname,
        'email' => $request->email,
        'userType' => $request->userType,
    ];
    if ($request->password) {
        $password = bcrypt($request->password);
        $data['password'] = $password;
    }
    $user = User::where('id', $request->id)->update($data);
    return $user;
}

// user login here start
public function login_User(Request $request){
  $this->validate($request, [
    'email' => 'required',
    'password' => 'bail|required|min:6',
    
]);
if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
  $user = Auth::User();
  if ($user->userType == 'User') {
    Auth::logout();
    return response()->json([
      'msg' => 'Incorrect login details',
     ], 401);
  }
 return response()->json([
  'msg' => 'You are Logged in',
 ]);
}else{
  return response()->json([
    'msg' => 'Incorrect login details',
   ], 401);
}

}






// main end line
}
