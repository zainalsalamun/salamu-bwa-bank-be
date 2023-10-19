<?php
use App\Models\User;
use App\Models\Wallet;
use Melihovv\Base64ImageDecoder\Base64ImageDecoder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


function getUser($param) {
    $user = User::where('id', $param)
    ->orWhere('email', $param)
    ->orWhere('username', $param)
    ->first();

    $wallet = Wallet::where('user_id', $user->id)->first();
    $user->profile_picture = $user->profile_picture ? url('storage/'.$user->profile_picture) : "";
    $user->ktp = $user->profile_picture ? url('storage/'.$user->ktp) : null;
    $user->balance = $wallet->balance;
    $user->card_number = $wallet->card_number;
    $user->pin = $wallet->pin;

    return $user;

}

function pinChecker($pin){
    $userId= auth()->user()->id;
    $wallet= Wallet::where('user_id', $userId)->first();

    if (!$wallet) {
        return false;
    }

    if ($wallet->pin == $pin) {
        return true;
    }

    return false;
}

 function uploadBase64Image($base64Image)
    {
        $decoder = new Base64ImageDecoder($base64Image, $allowedFormats =['jpeg', 'png', 'gif']);
        $decodedContent = $decoder->getDecodedContent();
        $format = $decoder->getFormat();
        $image = Str::random(10).'.'.$format;
        Storage::disk('public')->put($image, $decodedContent);

        return $image;
    }
