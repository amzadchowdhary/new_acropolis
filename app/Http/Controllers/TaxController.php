<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function show()
    {
        $data = Tax::get();
        return view('tax_rate',['taxes'=>$data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:taxes'],
            'tax_percentage' => ['required','numeric','between:0.00,99.99'],
        ]);

        $tax = new Tax;
        $tax->name = $request['name'];
        $tax->tax_rate = $request['tax_percentage'];
        $tax->save();
        return $this->redirectTo('tax/rate','New tax rate has been added successfully.',true);
    }

    public function edit($id)
    {
        $tax = Tax::find($id);
        if(!is_null($tax)){
            $url = url('tax/update/'.$id);
            $title = "Update Tax Rate ";
            $data = compact('tax','url','title');
            return view('edit-tax')->with($data);
        }
        return $this->redirectTo('/tax-rate');
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30','unique:taxes,name,'.$id.'id'],
            'tax_percentage' => ['required','numeric','between:0.00,99.99'],
        ]);

        $tax = Tax:: find($id);
        $tax->name = $request->name;
        $tax->tax_rate = $request->tax_percentage;
        $tax->save();
        return $this->redirectTo('/tax/rate', 'Tax Rate has been updated successfully.',true);

    }

    public function delete(Request $request)
    {
        try{
            $tax = Tax::find($request['id']);
            if(!is_null($tax)){
                $tax->delete();
                $message = "Tax rate deleted successfully";
                $status = true;
            }else{
                $message = "Invalid Tax rate";
                $status = false;
            }

            return $this->redirectTo('tax/rate',$message, $status);

        }catch(\Exception $exception){

            return $this->redirectTo('tax/rate',$exception->getMessage(), false);
        }
    }
}
