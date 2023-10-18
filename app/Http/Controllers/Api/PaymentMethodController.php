<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class PaymentMethodController extends Controller
{
    public function index ()
    {
        $bank = PaymentMethod::where('status', 'active')
            ->where('code','!=', 'bwa')
            ->get()
            ->map(function ($item) {
                $item->thumbnail = $item->thumbnail ? url ('banks/'.$item->thumbnail) : "";
                return $item;
            });
        return response()->json($bank);
    }
}
