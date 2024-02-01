<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Traits\Common;   
use function messagecount;
class TestimonialController extends Controller
{
    use common;
    private $columns=[ 
        'name',
        'position',
        'content',
        'contents',
        'published',
        'image',];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials=Testimonial::get();
        return view('admin.testimonials',compact('testimonials'));
    }
    public function index2()
    {
        $testimonials=Testimonial::get();
        
        return view('testimonials',compact('testimonials'));
    }

    public function lastthree(){
        $lastThreeTestimonials = Testimonial::orderBy('id', 'desc')->limit(3)->get();
        return view('includes.testimonials',compact('lastThreeTestimonials'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addtestimonials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse{
    
        
            $data['published'] = (isset($request['published'])) ? true : false;
    
    
            $fileName=$this->uploadFile($request->image,'assets/images');
          
            $data['image']=$fileName;           
            $data['name'] = $request->input('name');
            $data['content'] = $request->input('content');
            $data['position'] = $request->input('position');
          
            
            Testimonial::create($data);        
       
            return redirect('admin/testimonials');
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
            $testimonials = Testimonial::findOrFail($id);
            return view("admin.edittestimonials", compact('testimonials'));
        } 
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        
        $data['published'] = (isset($request['published'])) ? true : false;
    
    
        if ($request->hasFile('image')) {
            $fileName = $this->uploadFile($request->file('image'), 'assets/images');
            $data['image'] = $fileName;
    
        }
          
               
            $data['name'] = $request->input('name');
            $data['content'] = $request->input('content');
            $data['position'] = $request->input('position');
          
    
        Testimonial::where('id', $id)->update($data);
    
   return "data updated";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Testimonial::findOrFail($id);
        $car->delete();
    
        return redirect('admin/testimonials')->with('message', "Testimonial with ID {$id} has been deleted.");
    }
}
