<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sales;
use App\Models\Product;
use Session;

class SalesController extends Controller
{
    public function index()
    {
        $indexData = Sales::all();
        if($indexData -> count() > 0){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 200,'index' => 'No Records Found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'customer_name'     => 'required|string|max:50',
            'customer_number'   => 'required|string|max:11',
            'customer_address'  => 'required|string|max:255',
            'Product_id'        => 'required|string|max:11',
            'sales_qty'         => 'required|string|max:11',
        ]);

        if($validator -> fails()){
            return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
        }else{
            $indexData= Sales::create([
                'customer_name'     => $request->customer_name,
                'customer_number'   => $request->customer_number,
                'customer_address'  => $request->customer_address,
                'Product_id'        => $request->Product_id,
                'sales_qty'         => $request->sales_qty,
            ]);

            if($indexData){
                return response()->json(['status' => 200,'index' => 'Data Submit Successfully'], 200);
            }else{
                return response()->json(['status' => 500,'index' => 'Something Went Wrong'], 500);
            } 
        };
    }
}
