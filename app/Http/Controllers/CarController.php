<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Traits\Common;        
use App\Models\Car;  
use App\Models\Message;  
use App\Models\Category;  
use function messagecount;
use App\Models\Testimonial;

class CarController extends Controller
{
    use common;
    private $columns=[ 
    'title',
    'content',
  
    'luggage',
    'doors',
    'passengers',
    'price',
    'active',
    'image',
    'category_id',];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $cars=Car::get();
     $readMessages = Message::get();
     $messageCount = messagecount();
    return view('admin.car',compact('cars', 'messageCount','readMessages')); 
      
    }
   
public function index2()
{
    $cars = Car::paginate(6); // Fetch 6 cars per page

    return view('listing', ['cars' => $cars]);
}
public function index3(){
    $cars=Car::get();
    $lastThreeTestimonials = Testimonial::orderBy('id', 'desc')->limit(3)->get();
    return view('homepage', [
        'cars' => $cars,
        'lastThreeTestimonials' => $lastThreeTestimonials,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messageCount = messagecount();
       
        $category=Category::select('id','categoryName')->get();
        return view('admin.addCar',compact('category','messageCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            
       
        $message=[
            'title.required'=>'title is required',
            'content.required'=>'title is required',
           
        ];
        $data=$request->validate([
            'title' => 'required|string',
            
            'price'=>"numeric",
          
            
            
        ],$message);
       
        $fileName=$this->uploadFile($request->image,'assets/images');
        $data['active'] = isset($request['active']);
        $data['image']=$fileName;
        $data['category_id'] = $request->input('category_id');
        $data['content'] = $request->input('content');
        $data['price'] = $request->input('price');
        $data['luggage'] = $request->input('luggage');
        $data['passengers'] = $request->input('passengers');
        $data['doors'] = $request->input('doors');
        Car::create($data);        
   
        return redirect('admin/carshow')->with('message', 'Car added successfully');

}

    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);

       
        return view('single', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(?int $id =null)
    {
        if ($id) {
            $category=Category::select('id','categoryName')->get();
            $car=Car::findOrFail($id);
           return view("admin.editcar",compact('car','category'));
        } 
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        $car = Car::findOrFail($id);

        $data['active'] = $request->has('active');
        $data['category_id'] = $request->input('category_id');
    
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->file('image'), 'assets/images');
            $data['image'] = $fileName;
    
            
        }
    
        Car::where('id', $id)->update($data);
    
        
        return redirect('admin/carshow')->with('message', "data updated");
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
    
        return redirect('admin/carshow')->with('message', "Car with ID {$id} has been deleted.");
    }



}