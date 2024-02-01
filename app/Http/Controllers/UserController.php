<?php

namespace App\Http\Controllers;

use App\Models\User;  
use App\Models\Message;  
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

use function messagecount;
class UserController extends Controller
{
    
    private $columns=[ 
        'name',
        'email',
        'password',
        'active',
    'username'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  $users=user::get();
        $messageCount = messagecount();
        $readMessages = Message::get();
        return view('admin.user', compact('users', 'messageCount','readMessages'));
       
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messageCount = messagecount();
        return view('admin.adduser', compact('messageCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse{
    
        
        $data['admin'] = (isset($request['active'])) ? true : false;


       
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['username'] = $request->input('username');
        $data['password'] = $request->input('password');
        
        User::create($data);        
   
        return redirect('admin/usershow');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(?int $id =null)
    {
        if ($id) {
            $users = User::findOrFail($id);
            return view("admin.edituser", compact('users'));
        } 
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        
        $data['admin'] = $request->has('active');
        $data['password'] = bcrypt($request->input('password'));
    
        User::where('id', $id)->update($data);
    
        return "Data updated";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = User::findOrFail($id);
        $car->delete();
    
        return redirect('admin/usershow')->with('message', "Car with ID {$id} has been deleted.");
    }
   
}
