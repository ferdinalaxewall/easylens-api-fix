<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transactions::with('products')->get();
        return response()->json($transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $latest = Transactions::orderBy('created_at', 'DESC')->first();
        $date = Carbon::now()->isoFormat('DDMMYY');
        $transaction_number = "";
        if($latest){
            $transaction_number = str_pad($latest->id + 1, 4, "0", STR_PAD_LEFT);
        }else{
            $transaction_number = str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $transaction_id = "TR-".$date."-".$transaction_number;

        try{
            Transactions::create([
                "transaction_id" => $transaction_id,
                "tenant_name" => $request->tenant_name,
                "product_id" => $request->product_id,
                "loan_length" => $request->loan_length,
                "status" => "sewa",
            ]);

            return response()->json("Successfully Created Transaction!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
