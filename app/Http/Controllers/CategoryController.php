<?php

namespace App\Http\Controllers;
use App\Models\Category;  
use App\Models\Car;  
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use function messagecount;
class CategoryController extends Controller
{private $columns=[ 

    
    'categoryName'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::get();
    return view('admin.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        return view('admin.addcategories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse{
    
        
        
       
        $data['categoryName'] = $request->input('categoryName');
      
        
        Category::create($data);        
   
        return redirect('admin/categories');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(?int $id =null)
    {
        if ($id) {
            $category =Category::findOrFail($id);
            return view("admin.editcategory", compact('category'));
        } 
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        
       
        $data['categoryName'] = $request->input('categoryName');
    
        Category::where('id', $id)->update($data);
    
        return redirect('admin/categories')->with('message', "data updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Find and delete all related cars
        $relatedCars = Car::where('category_id', $category->id)->get();
        foreach ($relatedCars as $car) {
            $car->delete();
        }
    
        // Now, delete the category
        $category->delete();
    
        return redirect('admin/categories')->with('message', "Category with ID {$id} has been deleted along with its related cars.");
    }
}
