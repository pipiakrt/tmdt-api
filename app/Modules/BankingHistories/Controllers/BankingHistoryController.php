<?php

namespace Modules\BankingHistories\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BankingHistory;
use App\Models\BankAccount;
use App\Models\User;
use Carbon\Carbon;

class BankingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'bank_id' => 'required',
            'content' => 'required',
            'amount_payment' => 'required',
        ]);

        $user = User::find($request->id);
        $bank = BankAccount::find($request->bank_id);
        
        $wallet = $user->wallet;
        $amount_next = $wallet - $request->amount_payment;
        $content = "$user->name Gửi yêu cầu rút tiền vào tài khoản: $bank->banking_number thuộc $bank->banking_name. với nội dung: $request->content. Số tiền trước khi rút: " . number_format($user->wallet, 0, '', '.') . " vnđ, Số tiền rút: " . number_format($request->amount_payment, 0, '', '.') . " vnđ, Số tiền sau rút: " . number_format($amount_next, 0, '', '.') . " vnđ";
        
        $user->update(['wallet' => $amount_next]);
        return BankingHistory::create([
            'user_id' => $user->id,
            'content' => $content,
            'amount_prev' => $wallet,
            'banking_number' => $bank->banking_number,
            'amount_payment' => $request->amount_payment,
            'amount_next' => $amount_next,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if ($request->type == 'all') 
        {
            return $user->bankingHistory()->orderBy('id', 'DESC')->simplePaginate(7);
        }
        else
        {
            return $user->bankingHistory()->where('type', $request->type)->orderBy('id', 'DESC')->simplePaginate(7);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}