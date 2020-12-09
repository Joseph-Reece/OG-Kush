<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Astrotomic\Translatable\Validation\RuleFactory;

class PaymentTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payType = PaymentType::orderBy('created_at', 'desc')->get();

        return view('admin.paymentTypes.index', compact('payType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd("create");


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'payment_id'=>'required',
            'name'=>'required',
            'icon'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = $this->uploadImage($icon, '');
            $data['icon'] = $file_name;
        }

        $paytype = new PaymentType();
        $paytype->fill($data);
        // dd($paytype);

        $paytype->save();

        return back()->with('success', 'Add Payment success!');

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
        dd($id);
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
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'payment_id'=>'required',
            'name'=>'required',
            'icon'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $file_name = $this->uploadImage($icon, '');
            $data['icon'] = $file_name;
        }

        $model = PaymentType::findOrFail($request->payment_id);
        $model->fill($data)->save();

        return back()->with('success', 'Update payment success!');
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
        $product = PaymentType::find($id);
        $path = $product->icon;

        if($this->deleteImage($path)){

            PaymentType::destroy($id);
             return back()->with('success', 'Delete payment success!');

        }else{

            dd('Try again');
        }
    }
}
