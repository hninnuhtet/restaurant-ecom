<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;


class ManagementController extends Controller
{
    public function index(){
        $date = Carbon::now()->subDays(3);
        $orders=Order::where('created_at', '>=', $date)->get();        

        return view('admin.management.index', ['orders'=>$orders]);
    }

    public function changeStatus(Request $request)
    {
        if(!$request->has('status')){
            $request->status = 0;
        }
        Order::where('id', $request->id)->update([
            'done' => $request->status,
        ]);

        if($request->overview){  
            return response()->json(['success'=>'Status change successfully.']);
        }
        return redirect()->route('admin.orderManagement.index');
    }

    public function show($id)
    {

        $order=Order::find($id);  
        $quantity = OrderDetail::where('order_id',$id)->pluck('quantity')->toArray();     

        return view('admin.management.show', ['order'=>$order, 'quantity'=>$quantity]);
    }
    
    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        return redirect()->route('admin.orderManagement.index')->with('success', 'Data has been deleted.'); 
    }
    
    // Order History
    public function history(){
        // $orders = Order::all();
        // // $quantities = OrderDetail::pluck('quantity')->toArray();
        // // dd($quantities);
        // return view('admin.management.history',['orders'=>$orders]);

        return view('admin.management.history');
    }
    
    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '' && $request->to_date != '')
            {
                $data = Order::whereBetween('created_at', array($request->from_date, $request->to_date))->get();            
            }
            else
            {
                $data = Order::all();
            }
            echo json_encode($data);
        }
    }
   

    public function his_show($id)
    {
        $order=Order::find($id);  
        $quantity = OrderDetail::where('order_id',$id)->pluck('quantity')->toArray();     

        return view('admin.management.his_show', ['order'=>$order, 'quantity'=>$quantity]);
    }

    public function his_destroy($id)
    {
        Order::where('id', $id)->delete();
        return redirect()->route('admin.orderHistory.history')->with('success', 'Data has been deleted.'); 
    }
}