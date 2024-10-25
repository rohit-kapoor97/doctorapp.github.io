<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BookApp;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Mail\UserMail;
use App\Mail\WelcomeUserMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\Department;

class doctorcontroller extends Controller
{
   public function index(){
    $dept=Department::get();
    return view('index', compact('dept'));
   }


   public function register(){
      return view('signin');
     }

     public function countrycode(){
      return view('inti');
     }
 
     public function otpverfiy(){
      $otp=otp::get();
        return view('otp', compact('otp'));
       }
 

 public function verifyotp(request $req){
     $req->validate([
    'otp' => ['required', 'digits:6'],
    ]);

  $user=User::latest()->first();

  $otp = otp::where('user_id', $user->id)->orWhere('status', 'unverified')->first();
 

  if(!$otp || Carbon::now()->greaterThan($otp->otp_expire)){
  return redirect()->route('otp.view')->with('timeout', 'OTP EXPIRED Or NOT FOUND,  Please Resend OTP' );
 }


 if($otp->otp_code == $req->otp){
  otp::where('status', 'unverified')->update([
    'status' => 'verified'
  ]);
  if(!Auth::user()){
 Auth::login($user);
}
  return redirect()->route('index.view')->with('success', 'You Login successfully, OTP Verified');
 }else{

 return redirect()->route('otp.view')->with('error', 'Unverified OTP,  Please Check OTP' );
    
 }
}


  public function resendOtp(request $req){
  $user=User::latest()->first();
  $carbon=Carbon::now();
  $olduser=otp::where('status', 'unverified')->first();

  $new=rand(100000, 999999);
  $newotp=otp::where('ver_email', $user->email)->orwhere('status', 'unverified')->update([
    'otp_code'=>$new,
    'otp_expire'=> $carbon->addMinutes(10),
  ]);

  Mail::to($user->email)->send(new UserMail($new));
  return redirect()->route('otp.view')->with('resend', 'OTP Resend Successfully, Please Check E-mail');
  }



  // admin panel
  public function dashview(){
    $user=User::whereNot('role','<=>','admin')->get();
    return view('admin panel.admin', compact('user'));
  }

  public function buttonview(){
    return view('admin panel.buttons');
  }

  public function formview(request $request){

   
    // if($request->ajax()){
  
    //   $dept=Department::get();
     
    //   return DataTables::of($dept)->addIndexColumn()->make(true);
    // };

    if ($request->ajax()) {
      $dept = Department::get();
     return DataTables::of($dept)
          ->addIndexColumn()
          ->addColumn('action', function($row){
              $btn = '<a href="'.route('dept.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>';
              return $btn;
          })->addColumn('delete', function($del){
            $btn = '<a href="'.route('dept.delete', $del->id).'" class="btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
          ->rawColumns(['action', 'delete'])
          ->make(true);
    };


       return view('admin panel.forms');
  }
   
  public function deleteuser($id){
    Department::findOrFail($id)->delete();
    return redirect()->route('form.view');
  }
  public function cardview(){
    return view('admin panel.cards');
  }

  public function chartview(){
    return view('admin panel.charts');
  }

  public function modalview(){
    return view('admin panel.modals');
  }

public function tableview(request $request){

       if($request->ajax()){
          $user=User::whereNot('role','<=>','admin')->get();
            return DataTables::of($user)->addIndexColumn()->make(true);
           };
            return view('admin panel.tables');
   }

public function dept(request $req){

  $req->validate([
       'depname'=>['required'],
        'depimg' => ['required']
        ]);

     $name=time().'.'. $req->file('depimg')->extension();

     $req->file('depimg')->move(public_path('department'), $name);
  

     $dept=Department::create([
           'dep_name' =>$req->depname,
           'dep_img'=> $name,
           
          ]);
          return redirect()->route('admin.view')->with('status', 'Department Add Successfully');

      
    
  
}


public function logoutUser(){
  $user=user::where('id')->first();

  Auth::logout($user);

}

public function deptedit($id){
  $edit=Department::findOrFail($id);
  return view('admin panel.edit', compact('edit'));

  
}

public function edit(request $req){

  $user=Department::where('id', $req->id)->first();
       if($req){
         $old=public_path('department/');
          if($user->dep_img != ''){
             $file=$old.$user->dep_img;
             unlink($file);
          }
            $img=time().'.'.$req->file('photo')->extension();
             $req->file('photo')->move(public_path('department'), $img);
            }
    
            $edit=department::where('id', $req->id)
            ->update([
                'dep_name'=>$req->name,
                 'dep_img'=>$img
                ]);
               return redirect()->route('form.view')->with('success', 'Department Updated Successfully');
}


// Appointment book

public function book(request $req){
  
  $req->validate([
   'pname'=>['required'],
    'phone'=>['required','max:10','min:10'],
    'pdepart'=>['required'],
    'pemail'=>['required','string', 'lowercase', 'email', 'max:255'],
    'pdes'=>['required'],
  ]);

  $book=BookApp::create([
    'pname'=>$req->pname,
    'phone'=>$req->phone,
    'pdepart'=>$req->pdepart,
    'pemail'=>$req->pemail,
    'pdes'=>$req->pdes

  ]);
  
  return redirect()->route('index.view')->with('message', 'Your Appointment book Successfully');
}




  // login

  public function accountview(){
    return view('pages.create-account');
  }

  public function loginview(){
    return view('pages.login');
  }

  public function forgetview(){
    return view('pages.forgot-password');
  }

  // search
  public function search(){
    return view('admin panel.search');
  }

  public function searchdep(request $req){
    $new=Department::get();
    if($req->ajax()){
       
      return Datatables::of($new)->filter(function($query){
         
        if(request()->has('search')){
                  $query->where('dep_name', 'LIKE', '%'.request('search').'%')->get();
                }

      }, true)->addIndexColumn()
      ->addColumn('action', function($row){
          $btn = '<a href="'.route('dept.edit', $row->id).'" class="btn btn-primary btn-sm">Edit</a>';
          return $btn;

      })->addColumn('delete', function($del){
        $btn = '<a href="'.route('dept.delete', $del->id).'" class="btn btn-danger btn-sm">Delete</a>';
        return $btn;
    })
      ->rawColumns(['action', 'delete'])
      ->make(true);
    }
    return view('admin panel.search');
  }

  // api

  public function addUser(request $request){


    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'img' => ['required'],
      'phone' => ['required','max:10','min:10'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
      'password' => ['required',  Rules\Password::defaults()],
      'role' => ['required'],
   ]);

 
  $imgname=time().'.'.$request->file('img')->extension();
  $request->file('img')->move(public_path('images'), $imgname);


$user = User::create([
  'name' =>$request->name,
  'img' =>$imgname,
  'cont-code' =>$request->cont_code,
  'phone' =>$request->phone,
  'email' =>$request->email,
  'password' =>Hash::make($request->password),
  'role' =>$request->role,
 ]);

 
return response()->json([
  'Success'=>'Data Submit Successfully',
  'user'=>$user
]);

  }
  public function login(request $req){
    if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
      return response()->json([
        'message'=>'You login Successfully',
      ]);
    }else{
      return response()->json([
        'message'=>'user not found',
      ]);
    }
  }
  public function form(request $request){
    $dept = Department::get();
    return response()->json([
      'data'=> $dept,
     ]);
   
}

public function editDept($id){
  $edit=Department::findOrFail($id);
  return response()->json([
   'message'=>'user find successfully',
   'edit'=>$edit

  ]);
  }

  public function editUser(request $req, $id){
  
    $user=Department::where('id', $req->id)->first();
         if($req){
           $old=public_path('department/');
            if($user->dep_img != '' && $user->dep_img == null){
               $file=$old.$user->dep_img;
               unlink($file);
            }
      
              $img=time().'.'.$req->file('dep_img')->extension();
            
               $req->file('dep_img')->move(public_path('department'), $img);
              }
      
              $edit=department::where('id', $req->id)
              ->update([
                  'dep_name'=>$req->dep_name,
                  'dep_img'=>$img
                  ]);
                 return response()->json(
                  ['success', 'Department Updated Successfully']);
  }

  public function deptdelete($id){
    $del=Department::findorFail($id)->delete();
    return response()->json([
      "message" =>"Department Deleted Successfully",
      'data' => $del

    ]);
  }
  

}
