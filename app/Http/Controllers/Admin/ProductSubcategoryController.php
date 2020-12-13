<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcategories = ProductSubCategory::all();
        $category = ProductCategory::all();

        return view('admin.products.subCategories', compact('subcategories','category'));
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
        //dd($request->input('name'));
        $this->validate($request, [
            'name'=>'required|string',
            'product_category_id' => 'required',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',

        ]);


            $data = $request->all();

            if ($request->hasFile('thumb')) {
                $thumb = $request->file('thumb');
                $thumb_file = $this->uploadImage($thumb, '');
                $data['thumb'] = $thumb_file;
            }

        $subcategory = new ProductSubCategory();

        $subcategory->fill($data);


        $subcategory->save();

        return back()->with('success', 'Add sub category success!');


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
        //dd($id);
        $this->validate($request, [
            'name'=>'required|string',
            'product_category_id' => 'required',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);


        $data = $request->all();
        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }


        $category = ProductSubCategory::find($request->id);

        $category->fill($data);

        $category->save();


        return back()->with('success', 'Edit Sub Category success!');


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

        $subcategory = ProductSubCategory::find($id);
        $path = $subcategory->thumb;

        if($this->deleteImage($path)){

            ProductSubCategory::destroy($id);
            return back()->with('success', 'Delete sub category success!');

       }
    }
}
