<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Order::create($request->all());
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

    public function asignAllOrders()
    {
        try {
            $orders = Order::where("driver_id", null)->get();
            foreach ($orders as $order) {
                $this->asignDriver($order->id);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function asignDriver($id)
    {
        try {
            $order = Order::find($id);
            if ($order->driver_id != null) {
                return response("Order is taken by Driver " . $order->driver->name, 400);
            }
            $best_driver = $order->asignDriver();
            $order->driver_id = $best_driver["driver_id"];
            $order->save();
            return response($best_driver, 200);
        } catch (\Throwable $th) {
            error_log($th);
            return response("error", 400);
        }
    }
}
