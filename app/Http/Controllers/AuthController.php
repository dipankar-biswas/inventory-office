<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function index(){
        $users = User::orderBy('id','DESC')->get();
        return view('pages.user.user_list',compact('users'));
    }

    public function create(){
        return view('pages.user.user_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|confirmed|min:8',
        ]);

        $user = new User();
        if($request->image){
            @unlink($user->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/user"),$paths);
            $path_url = 'upload/user/'.$paths;
            $user->image = $path_url;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($user){
            return redirect()->route('user.list')->with('success','User Created Successfully!');
        }else{
            return redirect()->back()->with('failure','User Not Created!');
        }
    }

    public function show($id){
        $users = User::findOrFail($id);
        return view('pages.user.user_edit',compact('users'));
    }

    public function edit(){
        return 'edit';
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$id],
        ]);
        
        $user = User::findOrFail($id);
        if(Auth::user()->name == $user->name || Auth::user()->name == 'Admin'){
            if($request->image){
                @unlink($user->image);
                $path = $request->image;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("upload/user"),$paths);
                $path_url = 'upload/user/'.$paths;
                $user->image = $path_url;
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            if($user){
                return redirect()->route('user.list')->with('success','User Update Successfully!');
            }else{
                return redirect()->back()->with('failure','User Not Updated!');
            }
        }
    }

    public function delete($id){
        $user = User::findOrFail($id);
        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        if($user){
            return redirect()->route('user.list')->with('success','User Account Deactive Successfully!');
        }else{
            return redirect()->back()->with('failure','User Account Not Deactive!');
        }
    }

}
