<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;
use App\Models\Product;



class ProductController extends Controller
{

    public function show()
    {
        $products = Product::with('taxes')->get();
        return view('products',compact('products'));
    }


    public function create()
    {
        $taxes = Tax::get();
        return view('auth.product-register',['taxes'=>$taxes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:products'],
            'cost' => ['required','numeric'],
            'tax_rate' => ['required','exists:taxes,id'],
        ]);

        $product = new Product;
        $product->name = $request['name'];
        $product->cost = $request['cost'];
        $product->tax_rate_id = $request['tax_rate'];
        $product->save();
        return $this->redirectTo('/products','New Product has been added successfully.',true);

    }


    public function edit($id)
    {
        $product = Product::with('taxes')->find($id);
        if(!is_null($product)){
            $taxes = Tax::get();
            $url = url('update/product/'.$id);
            $title = "Update Product details ";
            $data = compact('product','url','title','taxes');
            return view('edit-product')->with($data);
        }
        return $this->redirectTo('/products');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:products,name,'.$id.'id'],
            'cost' => ['required','numeric'],
            'tax_rate' => ['required','exists:taxes,id'],
        ]);

        $product = Product:: find($id);
        $product->name = $request->name;
        $product->cost = $request['cost'];
        $product->tax_rate_id = $request['tax_rate'];
        $product->save();
        return $this->redirectTo('/products', 'Product details has been updated successfully.',true);
    }

    public function delete(Request $request)
    {
        try{
            $product = Product::find($request['id']);
            if(!is_null($product)){
            $product->delete();
            $message = "Product deleted successfully";
            $status = true;
            }
            else
            {
            $message = "Invalid Product";
            $status = false;
            }
            return $this->redirectTo('products',$message, $status);
        }
        catch(\Exception $exception){
            return $this->redirectTo('products',$exception->getMessage(), false);
        }

    }


}
