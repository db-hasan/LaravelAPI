<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        // $indexData = Product::all();
        $indexData = Product::orderBy('id', 'desc')->get();
        if($indexData -> count() > 0){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 200,'message' => 'No Records Found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:50',
            'product_sku' => 'required|string|max:11',
            'mfg_cost' => 'required|string|max:11',
            'sales_price' => 'required|string|max:11',
            'product_qty' => 'required|string|max:11',
            'product_des' => 'required|string|max:255',
            // 'thumbnail_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_img.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
        } else {
            // $thumbnail = time().'.'. $request->thumbnail_img->extension();
            // $request->thumbnail_img->move(public_path('images'),$thumbnail);

            $imageNames = [];
            foreach ($request->file('product_img') as $image) {
                $imageName = time() . '_' . rand() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }

            $indexData = Product::create([
                'product_name' => $request->product_name,
                'product_sku' => $request->product_sku,
                'mfg_cost' => $request->mfg_cost,
                'sales_price' => $request->sales_price,
                'product_qty' => $request->product_qty,
                'product_des' => $request->product_des,
                // 'thumbnail_img' => $thumbnail,
                'product_img' => json_encode($imageNames),
            ]);

            if ($indexData) {
                return response()->json(['status' => 200, 'message' => 'Data Submit Successfully'], 200);
            } else {
                // If something goes wrong, delete the uploaded images
                foreach ($imageNames as $imageName) {
                    unlink(public_path('images') . '/' . $imageName);
                }

                return response()->json(['status' => 500, 'message' => 'Something Went Wrong'], 500);
            }
        }
    }
    
    // ---------INSERT DATA WITH SINGLE IMAGE----------  
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'product_name' => 'required|string|max:50',
    //         'product_sku' => 'required|string|max:11',
    //         'mfg_cost' => 'required|string|max:11',
    //         'sales_price' => 'required|string|max:11',
    //         'product_qty' => 'required|string|max:11',
    //         'product_des' => 'required|string|max:255',
    //         'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and maximum size
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => 422, 'errors' => $validator->messages()], 422);
    //     } else {
    //         $imageName = time().'.'. $request->product_img->extension();
    //         $request->product_img->move(public_path('images'),$imageName);

    //         $indexData = Product::create([
    //             'product_name' => $request->product_name,
    //             'product_sku' => $request->product_sku,
    //             'mfg_cost' => $request->mfg_cost,
    //             'sales_price' => $request->sales_price,
    //             'product_qty' => $request->product_qty,
    //             'product_des' => $request->product_des,
    //             'product_img' => $imageName, // Save the image path in the database
    //         ]);

    //         if ($indexData) {
    //             return response()->json(['status' => 200, 'message' => 'Data Submit Successfully'], 200);
    //         } else {
    //             // If something goes wrong, delete the uploaded image
    //             Storage::disk('public')->delete($imageName);

    //             return response()->json(['status' => 500, 'message' => 'Something Went Wrong'], 500);
    //         }
    //     }
    // }


    // ---------INSERT DATA WITH OUT IMAGE----------
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'product_name'=> 'required|string|max:50',
    //         'product_sku' => 'required|string|max:11',
    //         'mfg_cost'    => 'required|string|max:11',
    //         'sales_price' => 'required|string|max:11',
    //         'product_qty' => 'required|string|max:11',
    //         'product_des' => 'required|string|max:255',
    //         'product_img' => 'required|string|max:255'
    //     ]);

    //     if($validator -> fails()){
    //         return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
    //     }else{
    //         $indexData= Product::create([
    //             'product_name'  => $request->product_name,
    //             'product_sku'   => $request->product_sku,
    //             'mfg_cost'      => $request->mfg_cost,
    //             'sales_price'   => $request->sales_price,
    //             'product_qty'   => $request->product_qty,
    //             'product_des'   => $request->product_des,
    //             'product_img'   => $request->product_img,
    //         ]);

    //         if($indexData){
    //             return response()->json(['status' => 200,'message' => 'Data Submit Successfully'], 200);
    //         }else{
    //             return response()->json(['status' => 500,'message' => 'Something Went Wrong'], 500);
    //         } 
    //     };
    // }

    public function show($id)
    {
        $indexData = Product::find($id);
        if($indexData){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 404,'message' => 'No Records Found'], 404);
        }
    }
    

    public function edit($id)
    {
        $indexData = Product::find($id);
        if($indexData){
            return response()->json(['status' => 200,'index' => $indexData], 200);
        }else{
            return response()->json(['status' => 404,'message' => 'No Records Found'], 404);
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
            'product_img.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator -> fails()){
            return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
        }else{
            $indexData= Product::find($id);

            $imageNames = [];
            foreach ($request->file('product_img') as $image) {
                $imageName = time() . '_' . rand() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }
            if($indexData){$indexData -> update([
                'product_name'  => $request->product_name,
                'product_sku'   => $request->product_sku,
                'mfg_cost'      => $request->mfg_cost,
                'sales_price'   => $request->sales_price,
                'product_qty'   => $request->product_qty,
                'product_des'   => $request->product_des,
                'product_img'   => json_encode($imageNames),
            ]);
                return response()->json(['status' => 200,'message' => 'Data Update Successfully'], 200);
            }else{
                foreach ($imageNames as $imageName) {
                    unlink(public_path('images') . '/' . $imageName);
                }
                return response()->json(['status' => 404,'message' => 'Something Went Wrong'], 404);
            } 
        };
    }




    // public function update(Request $request, int $id)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'product_name'=> 'required|string|max:50',
    //         'product_sku' => 'required|string|max:11',
    //         'mfg_cost'    => 'required|string|max:11',
    //         'sales_price' => 'required|string|max:11',
    //         'product_qty' => 'required|string|max:11',
    //         'product_des' => 'required|string|max:255',
            
    //     ]);

    //     if($validator -> fails()){
    //         return response()->json(['status' => 422,'errors' => $validator ->messages()], 422);
    //     }else{
    //         $indexData= Product::find($id);
    //         if($indexData){$indexData -> update([
    //             'product_name'  => $request->product_name,
    //             'product_sku'   => $request->product_sku,
    //             'mfg_cost'      => $request->mfg_cost,
    //             'sales_price'   => $request->sales_price,
    //             'product_qty'   => $request->product_qty,
    //             'product_des'   => $request->product_des,
    //         ]);
    //             return response()->json(['status' => 200,'message' => 'Data Update Successfully'], 200);
    //         }else{
                
    //             return response()->json(['status' => 404,'message' => 'Something Went Wrong'], 404);
    //         } 
    //     };
    // }

    public function destroy($id)
    {
        $indexData = Product::find($id);
        if($indexData){
            $indexData -> delete();
            return response()->json(['status' => 200,'message' => 'Data Delete Successfully'], 200);
        }else{
            return response()->json(['status' => 404,'message' => 'No Records Found'], 404);
        }
    }

}
