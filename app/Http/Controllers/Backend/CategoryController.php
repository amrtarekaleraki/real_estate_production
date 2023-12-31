<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all',compact('categories'));
    }


    public function AddCategory()
    {
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request)
    {
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

       $notification = array(
            'message' => 'تم اضافه القسم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    }


    public function UpdateCategory(Request $request)
    {
            $category_id = $request->id;
            Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

       $notification = array(
            'message' => 'تم تحديث القسم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);

    }


    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'تم حذف القسم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
