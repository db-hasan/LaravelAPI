<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'product_name'=> 'required|string|max:50',
    //         'product_sku' => 'required|string|max:11',
    //         'mfg_cost'    => 'required|string|max:11',
    //         'sales_price' => 'required|string|max:11',
    //         'product_qty' => 'required|string|max:11',
    //         'product_des' => 'required|string|max:255',
    //         'product_img' => 'required|string|max:255',
    //     ]);

    //     if($validator -> fails()){
    //         return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
    //     }else{
    //         $indexDatas= Product::create([
    //             'product_name'  => $request->product_name,
    //             'product_des'   => $request->product_des,
    //             'mfg_cost'      => $request->mfg_cost,
    //             'sales_price'   => $request->sales_price,
    //             'product_qty'   => $request->product_qty,
    //             'product_des'   => $request->product_des,
    //             'product_img'   => $request->product_img,
    //         ]);

    //         if($indexDatas){
    //             return response()->json(['status' => 200,'index' => 'Data Submit Successfully'], 200);
    //         }else{
    //             return response()->json(['status' => 500,'index' => 'Something Went Wrong'], 500);
    //         } 
    //     };
    // }

    
// =====================
    // public function create(){
    //     $indexData['indexCustomar']= Customar::all();
    //     return view('backend/collection/create', $indexData);
    // }
// =====================

    // public function store(Request $request){

    //     $data= new Product([
    //         'product_name'  => $request->input('product_name'),
    //         'product_des'   => $request->input('product_des'),
    //         'mfg_cost'      => $request->input('mfg_cost'),
    //         'sales_price'   => $request->input('sales_price'),
    //         'product_qty'   => $request->input('product_qty'),
    //         'product_des'   => $request->input('product_des'),
    //         'product_img'   => $request->input('product_img')
    //     ]);
    //     $data->save();
    //     return response()->json('Employee created!');
    // }

    
}
