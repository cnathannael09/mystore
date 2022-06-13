<?php

namespace App\Http\Controllers;

use App\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryModel = Transaction::all();
        // dd($queryModel);
        return view('transaction.index',compact('queryModel'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function showTransaction($id)
    {
        $data = Transaction::find($id);
        $medicines = $data->medicines;
        return view('transaction.showmodal', compact('id','medicines'));
    }

    public function showAjax(Request $request)
    {
        $id = ($request->get('id'));
        $data = Transaction::find($id);
        $medicines = $data->medicines;
        return response()->json(array(
            'msg'=> view('transaction.showmodal',compact('data','medicines'))->render()
        ), 200);
    }

    public function form_submit_front()
    {
        return view('frontend.checkout');
    }

    public function submit_front()
    {
        $cart = session()->get('cart');
        $user = Auth::user();
        $t = new Transaction;
        $t->buyer_id = $user->id;
        $t->user_id = 1;
        $t->transaction_date = Carbon::now()->toDateTimeString();
        // dd($t);
        $t->save();

        $totalharga = $t->insertProduct($cart, $user);
        $t->total = $totalharga;
        $t->save();

        session()->forget('cart');
        return redirect('home');
    }
}
