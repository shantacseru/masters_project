<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\UserExtra;
  

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $orders = DB::table('orders')
                                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                ->join('items', 'order_details.item_id', '=', 'items.id')
                                ->where('orders.user_id', '=', Auth::user()->id)
                                ->orderBy('orders.id', 'DESC')
                                ->get(array(
                                    'orders.id as o_id', 
                                    'orders.status as o_status', 
                                    'order_details.id as od_id',
                                    'orders.paid_amount as paid_amount',
                                     'orders.order_type as order_type',
                                     'orders.discount_amount as discount_amount',
                                     'order_details.quantity as quantity',
                                     'items.name as name',
                                     'order_details.per_item_price as per_item_price'));
         
        $returnRes = array();
        $temp = null;
        foreach ($orders as $key => $value) {
            # code...
            if($temp == null || $temp['order_id'] != $value->o_id) {

                if($temp != null) {

                    array_push($returnRes, $temp);
                }


               $temp = array(
                   "order_id" => $value->o_id,
                    "total_amount" => $value->paid_amount,
                    "order_type"=>$value->order_type,
                    "discount" => $value->discount_amount ? $value->discount_amount : 0,
                    "items" => array(
                        array(
                        "name" => $value->name,
                        "amount" => $value->quantity,
                        "unit_price"=>$value->per_item_price
                        )
                    ), 
                    "status" => $value->o_status
                );
                 
            } else {
                array_push($temp['items'], array(
                    "name" => $value->name,
                        "amount" => $value->quantity,
                        "unit_price"=>$value->per_item_price
                ));
            }



        }

        if($temp != null){

            array_push($returnRes, $temp);
        }
        return view('home', compact('returnRes'));
    }

    public function profile() {

        $user = Auth::user();

        $user_extra = DB::table('user_extras')
                            ->where('user_id', '=', $user->id)
                            ->get();

        if(isset($user_extra[0]))
            $user_extra = $user_extra[0];
        else {

            DB::table('user_extras')->insert(array('user_id' => $user->id));


            $user_extra = DB::table('user_extras')
                                ->where('user_id', '=', $user->id)
                                ->get();
            $user_extra = $user_extra[0];
        }

        return view('profile', compact('user', 'user_extra'));
        
    }


    public function update_user_info($value='')
    {

        $user_id = request('user_id');
        $password = bcrypt(request('password'));

        $data = array(
            'contact_no' => request('contact_no'),
            'home_address' => request('home_address'),
            'delivery_address' => request('delivery_address'),
        );


        $user = Auth::user();

        if ($user_id == $user->id) {


            if (request('password') != '') {

                DB::table('users')
                            ->where('id', $user_id)
                            ->update(array('password' => $password));
            }

            DB::table('user_extras')
                        ->where('user_id', $user_id)
                        ->update($data);

            return redirect()->route('profile');
        }

    }
}
