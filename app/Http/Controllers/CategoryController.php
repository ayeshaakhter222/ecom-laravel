<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    function category()
    {
        $categories = Category::all();
        $deleted_categories = Category::onlyTrashed()->get();
        return view('category.index', compact('categories', 'deleted_categories'));
    }

    function categorypost(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:20|min:2|unique:categories,category_name'

        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'created_at'=> Carbon::now()

        ]);

        return back()->with('category_insert_status', 'Category ' . $request->category_name .   ' Added Successfully!');
    }


    function categorydelete($category_id)
    {
        if(Category::where('id',$category_id)->exists()){
            Category::find( $category_id)->delete();

        }


        

        return back()->with('category_delete_status', 'Category deleted Successfully!');
    }

    function categoryalldelete()
    {

        Category::whereNull('deleted_at')->delete();
        return back()->with('category_delete_status', 'Category deleted Successfully!');
    }

    function categoryedit($category_id)
    {

        $category_info = Category::find($category_id);
        
        return view('category.edit', compact('category_info'));
    }
    function categoryeditpost(Request $request)

    {
        if ($request->category_name == Category::find($request->category_id)->category_name) {
            return back()->withErrors('The category name  have no change');
        }


        $request->validate([
            'category_name' => 'required|max:20|min:2|unique:categories,category_name'

        ]);

        Category::find($request->category_id)->update([
            'category_name' => $request->category_name
        ]);
        return redirect('category');
    }

    function categoryrestore($category_id)
    {
        Category::onlyTrashed()->where('id', $category_id)->restore();
        return back();
    }

    function categoryforcedelete($category_id)
    {
        Category::onlyTrashed()->where('id', $category_id)->forceDelete();
        return back();
    }

    function categorycheckdelete(Request $request)
    {
        if (isset($request->category_id)){
            foreach ($request->category_id as $single_category_id) {
                Category::find($single_category_id)->delete();
            }

            return back();
        } else{
            echo "checked not";
        }
       
     }

}
