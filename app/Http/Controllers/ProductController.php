<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsImages;
use App\Models\ProductCategories;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $search = $request->get('q');
        //dd($request->get('q'));
        $data = Products::select('products.id as id','name','short_description','description','category_id','product_categories.category')->with('images')->
         join('product_categories', 'product_categories.id', '=', 'products.category_id')->where('status', 1)->orderBy('products.id', 'DESC');
        if(!empty($search)) {
            $data = $data->where('name', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('product_categories.category', 'like', '%'.$search.'%');
        }
        $data = $data->get();
        $cat = ProductCategories::get()->pluck('category','id');
        // dd($cat->id);exit;
        return view('products', ['data' => $data, 'categories'=>$cat,'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        //
        $products = new Products();
        $products->name = $request->name;
        $products->short_description = $request->short_description;
        $products->description = $request->description;
        $products->status = $request->status;
        $products->category_id = $request->category_id;
        $products->save();
        $files = $request->file('attachment');

        if($request->hasFile('attachment'))
        {
            foreach ($files as $file) {
                //$val = $file->store('products');

                $file_name = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(base_path('public/images/'), $file_name);

                $img = new ProductsImages();
                $img->product_id = $products->id;
                $img->image_path = $file_name;
                $img->save();
            }
        }

         return redirect()->back()->with('success', 'Product Added Successfully');   


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Products::join('product_categories', 'products.category_id','product_categories.id')->find($id);
        $products_images = ProductsImages::where('product_id', $id)->get();
        return view('productsDetail', ['data'=> $data, 'products_images' => $products_images]);
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
