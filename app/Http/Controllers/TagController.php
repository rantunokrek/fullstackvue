<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Role;
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
    //   if ($user->userType == 'User') {
    //       return redirect('/login');
    //   }
      if ($request->path() == 'login') {
          return redirect('/');
      }
      return $this->checkForPermision($user, $request);
    
      return view('welcome');

    
  }
  public function checkForPermision($user, $request){
    $permission = json_decode($user->role->permission);
    $hasPermission = false;
    foreach ($permission as $p) {
       if ($p->name == $request->path()) {
       if ($p->read) {
       $hasPermission = true;
       }
       }
    }
    if ($hasPermission) return view('welcome') ;
    return view('notfound');
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
        'role_id' => 'required',
       
    ]);
    $password = bcrypt($request->password);
    $user = User::create([
        'fullname' => $request->fullname,
        'email' => $request->email,
        'password' => $password,
         'role_id' => $request->role_id
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
        'role_id' => 'required',
    ]);
    $data = [
        'fullname' => $request->fullname,
        'email' => $request->email,
        'role_id' => $request->role_id
    ];
    if ($request->password) {
        $password = bcrypt($request->password);
        $data['password'] = $password;
    }
    $user = User::where('id', $request->id)->update($data);
    return $user;
}

// user login here start
public function admin_login(Request $request){
   // validate request
   $this->validate($request, [
    'email' => 'bail|required|email',
    'password' => 'bail|required|min:6',
]);
if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    $user = Auth::user();
    if ($user->role->isAdmin == 0) {
        Auth::logout();
        return response()->json([
            'msg' => 'Incorrect login details',
        ], 401);
    }
    return response()->json([
        'msg' => 'You are logged in',
        'user' => $user,
    ]);
} else {
    return response()->json([
        'msg' => 'Incorrect login details',
    ], 401);
}

}

 // Role add line
 public function addRole(Request $request)
    {
        // validate request
        $this->validate($request, [
            'roleName' => 'required',
          
          
        ]);
        return Role::create([
            'roleName' => $request->roleName,
        ]);
    }
    public function editRole(Request $request)
    {
        // validate request
        $this->validate($request, [
            'roleName' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'roleName' => $request->roleName,
        ]);
    }
    public function getRoles()
    {
        return Role::all();
    }

// Assign Roll
      public function assignRoll(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required',
            'id' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'permission' => $request->permission
        ]);
    }


    




// main end line
}
