<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search') ?? "";
        if($search != "")
        {
            $results = Category::where('category','like',"%$search%")->paginate(10);
            
            return view('categories',["data"=>$results]);
        }
        $index=Category::paginate(10);
        return view('categories',['data'=>$index]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
               'category'=>'required|unique:categories'
        ]);
        
        $cat = new Category;
        $cat->category = $request->category;
        $cat->save();
        return redirect('products')->with('Success',"Category has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $products = $category->products()->paginate(5);
        $product_catgories = Category::all();
        return view('products',['data'=>$products,'category_name'=>$category->category,'product_catgories'=>$product_catgories]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $categories = Category::where('id',$id)->first();
        return view('editCategory',['categories'=>$categories]);    
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
        $request->validate([
            'category'=>'required|unique:categories'
           
        ]);
        
        $data = Category::where('id',$id)->first();
        $data->category=$request->category;
        $data->save();
        return redirect('category')->with('Success','Category has been Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =  Category::where('id',$id)->first();
        
      

    // Delete the image folder
    
        $oldImageFolder = public_path("product_images/$data->id");
        if (File::exists($oldImageFolder)) 
        {
            File::deleteDirectory($oldImageFolder);
        }
    
       
    
        $data->delete();
        return redirect('category')->with('Success',"Category has been deleted");
    }
}
