<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.category.index', ['data'=>$data]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);

        Category::create([
            'name' => $request->name,
        ]);     

        return redirect('admin/category/create')->with('success', 'Data has been added.');
    }

    // public function show($id)
    // {
    //     $data = Category::find($id);
    //     return view('roomtype.show', ['data'=>$data]);
    // }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin.category.edit', ['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('admin.category.index')->with('success', 'Data has been deleted.'); 
    }
}
