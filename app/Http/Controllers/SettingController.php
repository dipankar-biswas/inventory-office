<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function SettingPage(){
        $setting = Setting::where('id',1)->first();
        return view('pages.setup.setting',compact('setting'));
    }
    

    public function SettingHeaderUpdate(Request $req) {
        if(count(Setting::get()) == 0){
            $errors = Validator::make($req->all(),[
                "header_logo" => "required",
            ]);
    
            if ($errors->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => $errors->errors()
                ]);
            }
            $setting = new Setting;
            if($req->header_logo){
                $path = $req->header_logo;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->header_logo = $path_url;
            }
            $setting->save();
        }else{
            $setting = Setting::where('id',1)->first();
            if($req->header_logo){
                $path = $req->header_logo;
                @unlink($setting->header_logo);
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->header_logo = $path_url;
            }
            $setting->save();
        }
        if($setting){
            Session::put("success","Setting Header Logo updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Setting Header Logo not updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }
    }
    public function SettingInformationUpdate(Request $req) {
        
        
        if(count(Setting::get()) == 0){
            $errors = Validator::make($req->all(),[
                "company_name" => "required",
                "phone" => "required",
                "email" => "required",
                "address" => "required",
            ]);
    
            if ($errors->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => $errors->errors()
                ]);
            }
            $setting = new Setting;
            $setting->company_name = $req->company_name;
            $setting->phone = $req->phone;
            $setting->email = $req->email;
            $setting->address = $req->address;
            $setting->save();
        }else{
            $setting = Setting::where('id',1)->first();
            $setting->company_name = $req->company_name;
            $setting->phone = $req->phone;
            $setting->email = $req->email;
            $setting->address = $req->address;
            $setting->save();
        }

        if($setting){
            Session::put("success","Setting Information updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Setting Information not updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        };
    }
    public function SettingSocialUpdate(Request $req) {
        
        if(count(Setting::get()) == 0){
            $errors = Validator::make($req->all(),[
                "facebook" => "required",
                "instagram" => "required",
                "twitter" => "required",
                "linkedin" => "required",
                "youtube" => "required",
            ]);
    
            if ($errors->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => $errors->errors()
                ]);
            }
            $setting = new Setting;
            $setting->facebook = $req->facebook;
            $setting->instagram = $req->instagram;
            $setting->twitter = $req->twitter;
            $setting->linkedin = $req->linkedin;
            $setting->youtube = $req->youtube;
            $setting->save();
        }else{
            $setting = Setting::where('id',1)->first();
            $setting->facebook = $req->facebook;
            $setting->instagram = $req->instagram;
            $setting->twitter = $req->twitter;
            $setting->linkedin = $req->linkedin;
            $setting->youtube = $req->youtube;
            $setting->save();
        }

        if($setting){
            Session::put("success","Setting Information updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Setting Information not updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        };
    }
    public function SettingFooterUpdate(Request $req) {
        
        if(count(Setting::get()) == 0){
            $errors = Validator::make($req->all(),[
                "footer_logo" => "required",
                "footer_content" => "required",
            ]);
    
            if ($errors->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => $errors->errors()
                ]);
            }
            $setting = new Setting;
            if($req->footer_logo){
                @unlink($setting->footer_logo);
                $path = $req->footer_logo;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->footer_logo = $path_url;
            }
            $setting->footer_content = $req->footer_content;
            $setting->save();
        }else{
            $setting = Setting::where('id',1)->first();
            if($req->footer_logo){
                @unlink($setting->footer_logo);
                $path = $req->footer_logo;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->footer_logo = $path_url;
            }
            $setting->footer_content = $req->footer_content;
            $setting->save();
        }

        if($setting){
            Session::put("success","Footer Information updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Footer Information not updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        };
    }
    public function SettingCopyrightUpdate(Request $req) {
        
        if(count(Setting::get()) == 0){
            $errors = Validator::make($req->all(),[
                "copyright_image" => "required",
                "copyright_text" => "required",
            ]);
    
            if ($errors->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "error",
                    "data" => $errors->errors()
                ]);
            }
            $setting = new Setting();
            if($req->copyright_image){
                $path = $req->copyright_image;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->copyright_image = $path_url;
            }
            $setting->copyright_text = $req->copyright_text;
            $setting->save();
        }else{
            $setting = Setting::where('id',1)->first();
            if($req->copyright_image){
                @unlink($setting->copyright_image);
                $path = $req->copyright_image;
                $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("settingImage"),$paths);
                $path_url = 'settingImage/'.$paths;
                $setting->copyright_image = $path_url;
            }
            $setting->copyright_text = $req->copyright_text;
            $setting->save();
        }

        if($setting){
            Session::put("success","Copyright Information updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Copyright Information not updated!");
            return response()->json([
                "status"=>"reload"
            ]);

        };
    }
}
