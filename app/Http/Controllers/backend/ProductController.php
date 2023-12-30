<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        $indexData = Product::all();
        if($indexData -> count() > 0){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 200,'index' => 'No Records Found'], 404);
        }
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_name'=> 'required|string|max:50',
            'product_sku' => 'required|string|max:11',
            'mfg_cost'    => 'required|string|max:11',
            'sales_price' => 'required|string|max:11',
            'product_qty' => 'required|string|max:11',
            'product_des' => 'required|string|max:255',
            'product_img' => 'required|string|max:255'
        ]);

        if($validator -> fails()){
            return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
        }else{
            $indexData= Product::create([
                'product_name'  => $request->product_name,
                'product_sku'   => $request->product_sku,
                'mfg_cost'      => $request->mfg_cost,
                'sales_price'   => $request->sales_price,
                'product_qty'   => $request->product_qty,
                'product_des'   => $request->product_des,
                'product_img'   => $request->product_img,
            ]);

            if($indexData){
                return response()->json(['status' => 200,'message' => 'Data Submit Successfully'], 200);
            }else{
                return response()->json(['status' => 500,'message' => 'Something Went Wrong'], 500);
            } 
        };
    }

    public function show($id)
    {
        $indexData = Product::find($id);
        if($indexData){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 404,'index' => 'No Records Found'], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(),[
            'product_name'=> 'required|string|max:50',
            'product_sku' => 'required|string|max:11',
            'mfg_cost'    => 'required|string|max:11',
            'sales_price' => 'required|string|max:11',
            'product_qty' => 'required|string|max:11',
            'product_des' => 'required|string|max:255',
            'product_img' => 'required|string|max:255'
        ]);

        if($validator -> fails()){
            return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
        }else{

            $indexData= Product::find($id);
            if($indexData){
                $indexData -> update([
                'product_name'  => $request->product_name,
                'product_sku'   => $request->product_sku,
                'mfg_cost'      => $request->mfg_cost,
                'sales_price'   => $request->sales_price,
                'product_qty'   => $request->product_qty,
                'product_des'   => $request->product_des,
                'product_img'   => $request->product_img,
            ]);
                return response()->json(['status' => 200,'index' => 'Data Update Successfully'], 200);
            }else{
                return response()->json(['status' => 404,'index' => 'Something Went Wrong'], 404);
            } 
        };
    }

    public function destroy($id)
    {
        $indexData = Product::find($id);
        if($indexData){
            $indexData -> delete();
        }else{
            return response()->json(['status' => 404,'index' => 'No Records Found'], 404);
        }
    }

}
