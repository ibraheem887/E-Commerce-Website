<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\View\Components\Message;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
            $results = Product::where('id','=',"$search")
            ->orwhere('TITLE','like',"%$search%")
            ->orwherehas('category',function($query)use($search)
        {
            $query->where('category','like',"%$search%");
        })->paginate(5);

            $product_catgories = Category::all();
            return view('products',["data"=>$results,'product_catgories'=>$product_catgories]);
        }
        else
        {
            $user = Product:: paginate(5) ;
            $product_catgories = Category::all();
            return view('products',['data'=>$user,'product_catgories'=>$product_catgories]);
        }
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('addProduct',['categories'=>$category]);
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
            'TITLE'=>'required|unique:products',
            'PRICE'=>'required|min:0',
            'QUANTITY'=>'required|min:0',
            'COLOR'=>'required',
            'DESCRIPTION'=>'required',
           'IMAGE' => 'required',
            'category_id'=>'required'
        ]);

        $data = new Product;
        $data->TITLE=$request->TITLE;
        $data->DESCRIPTION=$request->DESCRIPTION;
        $data->PRICE=$request->PRICE;
        $data->QUANTITY=$request->QUANTITY;
        $data->COLOR=$request->COLOR;
        $data->category_id=$request->category_id;

 
            $imagePaths=[];
            if($files=$request->file('IMAGE'))
            {
                $newImageFolder = public_path("product_images/$request->category_id/$request->TITLE");
                File::makeDirectory($newImageFolder, 0755, true, true);
                foreach($files as $key=>$image)
                {
                    $imagePath = time().$key.'.'.$image->extension();

                    $image->move($newImageFolder, $imagePath);
                    $imagePaths[]=$imagePath;
                }
                
          
            $data->IMAGE = json_encode($imagePaths);
            }
            else 
            {
                $data->IMAGE ='[]';
            }
       
        $data->save();
        return redirect('products')->with('Success',"Product has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::where('id',$id)->first();
        return view('show',['data'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::where('id',$id)->first();
        $category = Category::all();
        return view('edit',['data'=>$product,'categories'=>$category]);
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
        'TITLE' => 'required|unique:products',
        'PRICE' => 'required|min:0',
        'QUANTITY' => 'required|min:0',
        'COLOR' => 'required',
        'DESCRIPTION' => 'required',
       
        'category_id' => 'required',
    ]);



    $data = Product::where('id', $id)->first();

   
    $oldDirectoryPath = public_path("product_images/$data->category_id/$data->TITLE");
    $newDirectoryPath = public_path("product_images/$request->category_id/$request->TITLE");
    
    if (File::exists($oldDirectoryPath)) 
    {
        File::move($oldDirectoryPath, $newDirectoryPath);
    }
    

    $data->TITLE = $request->TITLE;
    $data->DESCRIPTION = $request->DESCRIPTION;
    $data->PRICE = $request->PRICE;
    $data->QUANTITY = $request->QUANTITY;
    $data->COLOR = $request->COLOR;
    $data->category_id = $request->category_id;

   

    if ($request->IMAGE) 
    {
        $imagePaths = json_decode($data->IMAGE, true);
        $oldImageFolder = public_path("product_images/$data->category_id/$data->TITLE");

        if (File::exists($oldImageFolder))
            {
                File::deleteDirectory($oldImageFolder);
            }
           
        
            $newImagePaths = [];
            if ($files = $request->file('IMAGE')) 
            {
                $newImageFolder = public_path("product_images/$request->category_id/$request->TITLE");
                File::makeDirectory($newImageFolder, 0755, true, true);
        
                foreach ($files as $key=>$image) {
                    $imagePath = time().$key . '.' . $image->extension();
                    $image->move($newImageFolder, $imagePath);
                    $newImagePaths[] = $imagePath;
                }
                $data->IMAGE = json_encode($newImagePaths);
            } else {
                $data->IMAGE = $data->IMAGE;
            }
        
        
        
        }
    

    $data->save();
    return redirect('products')->with('Success', 'Product has been Edited');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $data = Product::where('id', $id)->first();
    // Decode the JSON-encoded image paths
    $imagePaths = json_decode($data->IMAGE, true);

    // Delete the image files
    if ($imagePaths) 
    {
        $oldImageFolder = public_path("product_images/$data->category_id/$data->TITLE");
        if (File::exists($oldImageFolder)) 
        {
            File::deleteDirectory($oldImageFolder);
        }
    }

    // Delete the product record
    $data->delete();

    return redirect('products')->with('Success', 'Product has been Deleted');
 }
}

