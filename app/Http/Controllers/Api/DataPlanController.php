<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\TransactionType;
use App\Models\DataPlan;
use App\Models\DataPlanHistory;
use App\Models\PaymentMethod;
use App\Models\Transaction;

class DataPlanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data_plan_id' => 'required|integer',
            'phone_number' => 'required|string',
            'pin' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $userId = auth()->user()->id;

        $transactionType = TransactionType::where('code', 'internet')->first();

        $paymentMethod = PaymentMethod::where('code','bwa')->first();

        $userWallet = Wallet::where('user_id', $userId)->first();

        $dataPlan = DataPlan::find($request->data_plan_id);

        if (!$dataPlan) {
            return response()->json(['message' => 'Data Plan not found'], 404);
        }

        $pinChecker = pinChecker($request->pin);

        if (!$pinChecker) {
            return response()->json(['message' => 'Your PIN is wrong'], 400);
        }

        if ($userWallet->balance < $dataPlan->price) {
            return response()->json(['message' => 'Your balance is not enough'], 400);
        }

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => $userId,
                'payment_method_id' => $paymentMethod->id,
                'transaction_type_id' => $transactionType->id,
                'amount' => $dataPlan->price,
                'transaction_code' => strtoupper(Str::random(10)),
                'description' => 'Internet Data Plan'.$dataPlan->name,
                'status' => 'success'
            ]);

            DataPlanHistory::create([
                'data_plan_id' => $dataPlan->id,
                'transaction_id' => $transaction->id,
                'phone_number' => $request->phone_number,
            ]);

            $userWallet->decrement('balance', $dataPlan->price);

            DB::commit();
            return response()->json(['message' => 'Buy Data Plan Success'], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
