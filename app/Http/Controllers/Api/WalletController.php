<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class WalletController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $wallet = Wallet::select('pin','balance','card_number')
            ->where('user_id', $user->id)
            ->first();

            return response()->json($wallet);
    }


}
