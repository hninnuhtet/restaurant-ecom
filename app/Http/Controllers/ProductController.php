<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use File;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('admin.product.index', ['data'=>$data]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories'=>$categories]);
    }

    public function show($id)
    {
        $data = Product::find($id);
        return view('admin.product.show', ['data'=>$data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);
                
        $imgPath = $request->file('photo')->move('img');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'gallery' => $imgPath,
        ]);     

        return redirect('admin/product/create')->with('success', 'Data has been added.');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $data = Product::find($id);
        return view('admin.product.edit', ['data'=>$data, 'categories'=>$categories]);
    }

    
    public function update(Request $request, $id)
    {
        if($request->hasFile('photo')){
            $data = Product::find($id);
            $oldPath = $data->gallery;
            File::delete($oldPath);

            $imgPath = $request->file('photo')->move('img');
            Product::where('id', $id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'gallery' => $imgPath,
            ]);
        } else{
        Product::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);
        }        
        return redirect()->route('admin.product.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $data=Product::find($id);        
        Product::where('id', $id)->delete();
        File::delete($data->gallery);
        return redirect()->route('admin.product.index')->with('success', 'Data has been deleted.'); 
    }
}
