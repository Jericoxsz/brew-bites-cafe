<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'cropped_image'=>'nullable'
        ]);

        $user=Auth::user();

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        if($request->cropped_image){

            $image=str_replace('data:image/jpeg;base64,','',$request->cropped_image);
            $image=str_replace(' ','+',$image);

            $filename='profile_'.time().'.jpg';

            Storage::disk('public')->put(
                'profiles/'.$filename,
                base64_decode($image)
            );

            $user->update([
                'profile_image'=>'profiles/'.$filename
            ]);
        }

        return back()->with('status','Profile updated successfully.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password'=>'required|min:8|confirmed'
        ]);

        Auth::user()->update([
            'password'=>Hash::make($request->password)
        ]);

        return back()->with('status','Password updated successfully.');
    }
}