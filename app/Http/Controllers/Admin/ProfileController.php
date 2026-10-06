<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('admin.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);


        $user = Auth::user();


        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);



        if($request->profile_image){


            $image = $request->profile_image;


            $image = str_replace(
                'data:image/jpeg;base64,',
                '',
                $image
            );


            $image = str_replace(' ','+',$image);



            $imageName = 'profile_'.time().'.jpg';



            Storage::disk('public')
                ->put(
                    'profiles/'.$imageName,
                    base64_decode($image)
                );



            $user->update([
                'profile_image'=>'profiles/'.$imageName
            ]);

        }


        return redirect('/admin/profile')
            ->with('success','Profile updated successfully.');
    }



    public function password(Request $request)
    {

        $request->validate([

            'current_password'=>'required',

            'password'=>'required|min:8|confirmed'

        ]);



        $user = Auth::user();



        if(!Hash::check(
            $request->current_password,
            $user->password
        )){

            return back()
            ->withErrors([
                'current_password'=>'Current password is incorrect.'
            ]);

        }



        $user->update([

            'password'=>Hash::make(
                $request->password
            )

        ]);



        return back()
        ->with('success','Password updated successfully.');

    }
}