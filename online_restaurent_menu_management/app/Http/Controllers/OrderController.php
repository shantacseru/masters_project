<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $cart = request('cart');
        $userId = request('userId');
        $form = request('form');

        $orderDetailsValues = array();
         
        $totalToPay = 0;

        for($i = 0, $nc = sizeof($cart); $i < $nc; $i++) {

            $totalToPay += $cart[$i]['amount'] * $cart[$i]['unit_price'];
        }
        
        if(Auth::check() || $userId) {

            /// $user = Auth::user(); 
            // $method = $form[2]['value'];
            $tableNo = $form[2]['value'];
            $method = $form[3]['value'];
            
            $orderValues = array(
                'user_id'=> $userId,
                'payment_type_id'=> $method == 'hand' ? 1 : 2,
                'status'=> 'Pending',
                'created_at'=> \Carbon\Carbon::now(),
                'paid_amount'=> $totalToPay,
                'finally_paid_amound'=> 0,
                'has_paid'=> "Pending",
                'order_type'=> 'In house',
                'table_id'=> $tableNo
            );

            if ($tableNo == '')
                $orderValues['order_type'] = 'Online';


        } else {

            $name = $form[1]['value'];
            $tableNo = $form[2]['value'];
            $method = $form[3]['value'];
            $orderValues = array(
                'payment_type_id'=> $method == 'hand' ? 1 : 2,
                'status'=> 'Pending',
                'created_at'=> \Carbon\Carbon::now(),
                'paid_amount'=> $totalToPay,
                'finally_paid_amound'=> 0,
                'has_paid'=> "Pending",
                'order_type'=> 'In house',
                'table_id'=> $tableNo
            );
        }
         
 
        $orderId = DB::table('orders')->insertGetId($orderValues);

        for($i = 0, $nc = sizeof($cart); $i < $nc; $i++) {

            array_push($orderDetailsValues, array(
                'order_id'=> $orderId,
                'item_id'=> $cart[$i]['id'] ,
                'quantity' => $cart[$i]['amount'],
                'status' => 'Pending',
                'per_item_price'=>$cart[$i]['unit_price'],
                'created_at'=> \Carbon\Carbon::now(),
            ));

            $totalToPay += $cart[$i]['amount'] * $cart[$i]['unit_price'];
       
        }

        if(Auth::check() || $userId) {

            $user_history = array(
                'user_id'=> $userId,
                'order_id'=> $orderId,
                'number_of_items'=> count($orderDetailsValues),
                'paid_amount'=> $totalToPay,
                'created_at'=> \Carbon\Carbon::now(),
            );

            DB::table('user_order_histories')->insert($user_history);
        }

        
        DB::table('order_details')->insert($orderDetailsValues);
         return $method;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
