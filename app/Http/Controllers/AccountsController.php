<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $users = Accounts::all();
            return response()->json($users, 200);
        }catch(\Exception $error){
            return response()->json(["message" => $error], 500);
        }
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
        try{
            Accounts::create([
                "full_name" => $request->full_name,
                "email" => $request->email,
                "username" => $request->username,
                "password" => $request->password,
                "roles" => $request->roles
            ]);

            return response()->json("Successfully Created User!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        try{
            $accounts = Accounts::where('id', $id)->first();
            return response()->json($accounts, 200);
            
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function edit(Accounts $accounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            Accounts::where('id', $id)->update([
                "full_name" => $request->full_name,
                "email" => $request->email,
                "username" => $request->username,
                "password" => $request->password,
                "roles" => $request->roles
            ]);

            return response()->json("Successfully Updated User!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Accounts::where('id', $id)->delete();
            return response()->json(['message' => 'Successfully Deleted User!'], 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }
}
