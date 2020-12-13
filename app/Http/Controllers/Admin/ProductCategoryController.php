<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = ProductCategory::all();

        return view('admin.products.categories', compact('categories'));
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
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);


        $data = $request->all();

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $category = new ProductCategory();

        $category->fill($data);

        $category->save();

        return back()->with('success', 'Add category success!');


    }

    public function update(Request $request)
    {
        //dd($id);
        $this->validate($request, [
            'name'=>'required|string',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',

        ]);

        $data = $request->all();

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb');
            $thumb_file = $this->uploadImage($thumb, '');
            $data['thumb'] = $thumb_file;
        }

        $category = ProductCategory::find($request->category_id);

        $category->fill($data);

        $category->save();


        return back()->with('success', 'Edit category success!');


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
        $category = ProductCategory::find($id);
        $path = $category->thumb;

        if ($this->deleteImage($path)) {
            # code...
            $subCategories = ProductSubCategory::where('product_category_id', $id)->delete();

            if ($subCategories) {

                ProductCategory::destroy($id);

            }

            return redirect()->back()->with('success', 'Category Deleted Successfully');
        }


    }
}
