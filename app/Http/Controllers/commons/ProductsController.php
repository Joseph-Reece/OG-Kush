<?php

namespace App\Http\Controllers\commons;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
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

        // $data = $request->all();
       $this->validate($request, [
            'name'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'weight'=>'required',
            'thumb'=>'required',
            'description'=>'required',
            'weight'=>'required',
            'sub_category_id'=>'required',
            'thumb'=>'required',
       ],
        //    Validation messages
       [
           'thumb.required' => 'A product has to have an image.',
           'category_id.required' => 'Please select one category.',
           'name.required' => 'Please provide the name of the product.',
           'price.required' => 'Please input the price of the product.'
        ]
    );
       $data = $request->all();
       $name = $data['name'];

       $slug = \Illuminate\Support\Str::slug($name);
       $data['slug'] = $slug;

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['image'] = $thumb_file;

        }


        // dd($data);

        $product = new Product();

        $product->fill($data);



        if ($product->save()) {
            return redirect()->back()->with('success', 'Product added Successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd($product);
        // dd($slug);
        // $product= Product::find($id);
        $related = Product::where('category_id', $product->category_id)->get();
        // dd($related);

        return view('frontend.place.product_details', compact('product', 'related'));
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

        $item = $request->id;
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['image'] = $thumb_file;

        }
        $data = $request->all();


        $slug = \Illuminate\Support\Str::slug($data['name']);
        $data['slug'] = $slug;

        dd($data);


        $product = Product::find($item);

        $product->fill($data);

        if ($product->save()) {
            return redirect()->back()->with('success', 'Product updated Successfully');
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
        $product = Product::find($id);
        $path = $product->image;

        if($this->deleteImage($path)){

             Product::destroy($id);
             return back()->with('success', 'Delete Product success!');

        }else{

            dd('Try again');
        }
    }

    public function getListByCategory($category_id)
    {
        $subCategory = ProductSubCategory::query();
        if ($category_id) {
            $subCategory->where('product_category_id', $category_id);
        }
        $subCategory = $subCategory->orderBy('created_at', 'desc')->get();
        return $subCategory;
    }
}
