<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    public function show()
    {
        $user = getUser(auth()->user()->id);
        return response()->json($user );
    }


    public function getUserByusername(Request $request, $username)
    {
        $user = User::select('id','name','username','profile_picture','verified')
        ->where('username','LIKE','%'.$username.'%')
        ->where('id','<>',auth()->user()->id)
        ->get();

        $user->map(function($item){
            $item->profile_picture = $item->profile_picture ? url($item->profile_picture) : '';
            return $item;
        });

        return response()->json($user);
    }


    public function update (Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            $data = $request->only('name','username','ktp','email','password');

            if ($request->username != $user->username) {
                $isExistUsername = User::where('username', $request->username)->exists();
                if ($isExistUsername) {
                    return response()->json(['errors'=> 'Username already exists'], 409);
                }
            }

            if ($request->email != $user->email) {
                $isExistEmail = User::where('email', $request->email)->exists();
                if ($isExistEmail) {
                    return response()->json(['errors'=> 'Email already exists'], 409);
                }
            }

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            if ($request->profile_picture) {
                $profile_picture = $this->uploadBase64Image($request->profile_picture);
                $data['profile_picture'] = $profile_picture;
                if ($user->profile_picture) {
                    Storage::delete('public/'.$user->profile_picture);
                }
            }

            if ($request->ktp) {
                $ktp = $this->uploadBase64Image($request->ktp);
                $data['ktp'] = $ktp;
                $data['verified'] = true;
                if ($user->ktp) {
                    Storage::delete('public/'.$user->ktp);
                }
            }


            $user->update($data);

            return response()->json(['message'=> 'User Update']);


        } catch (\Throwable $th) {
            return response()->json(['message'=> $th->getMessage()], 500);
        }
    }
}



