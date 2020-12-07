<?php

namespace App\Http\Controllers\commons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user= Auth::user()->id;
        // dd($request->all());

    //     $this->validate($request, [
    //         'name'=>'required',
    //         'description'=>'required',
    //         'details'=>'nullable',
    //         'image'=>'required',
    //    ],
    //    Validation messages
    //    [
    //        'name.required' => 'Deal has to have an name.',
    //        'description.required' => 'Please provide a short.',
    //        'image.required'=>'Please add an image',
    //     ]
    // );
       $data = $request->all();
        if ($request->hasFile('image')) {
            $thumb = $request->file('image');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['image'] = $thumb_file;

        }
        // $data['place_id'] = $place;

        $deal = new Deal();

        $deal->fill($data);
        $deal->name = $data['name'];

        if ($deal->save()) {
            return redirect()->back()->with('success', 'Deal added Successfully');
        }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        //
        $id = $request->deal_id;
        $data = $request->all();
        if ($request->hasFile('image')) {
            $thumb = $request->file('image');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['image'] = $thumb_file;
        }

        $deal = Deal::find($id);

        $deal->fill($data);
        $deal->name = $data['name'];
        if ($deal->save()) {
            return redirect()->back()->with('success', 'Deal updated Successfully');
        }

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
        $product = Deal::find($id);
        $path = $product->image;

        if($this->deleteImage($path)){

             Deal::destroy($id);
             return back()->with('success', 'Delete Deal success!');

        }else{

            dd('Try again');
        }
    }
}
