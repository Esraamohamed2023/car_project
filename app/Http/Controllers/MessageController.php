<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Message;
use function messagecount;
class MessageController extends Controller
{
    private $columns=[ 
        'first_name',
        'Content',
      
        'last_name',
        'email',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::get();

    
    foreach ($messages as $message) {
        $message->is_read = true;
        $message->save();
    }

    
    return view('admin.showmessage', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
   
    {
        $messages = Message::get();
        return view('admin.messages', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data['first_name'] = $request->input('first_name');
        $data['last_name'] = $request->input('last_name');
        $data['email'] = $request->input('email');
        $data['Content'] = $request->input('content');
        
       Message::create($data);        
   
       return redirect('frontend/contactpage');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $messages =Message::findOrFail($id);

       
        return view('admin.messagedetails', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(?int $id =null)
    {
        if ($id) {
            $users =Category::findOrFail($id);
            return view("admin.edituser", compact('users'));
        } 
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
       
        $data['categoryName'] = $request->input('categoryName');
    
        Category::where('id', $id)->update($data);
    
        return "Data updated";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Message::findOrFail($id);
        $car->delete();
    
        return redirect('admin/messages')->with('message', "message with ID {$id} has been deleted.");
    }
    




    public function messagecount()
{
    $messageCount = Message::where('is_read', false)->count();

    $readMessages = Message::get();
    return view('admin.includes.topbar', compact('messageCount'));
}

}
