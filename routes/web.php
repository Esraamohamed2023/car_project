<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\MessageController;

use App\Models\Category;
use App\Models\Message;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Testimonial;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('frontend.welcome');
/** start pages */

Route::prefix('frontend')->group(function () {
   


    Route::get('/homepage',[CarController::class,'index3'])->name('frontend.home');

    Route::get('/aboutpage', function () {
        return view('about');
    })->name('frontend.about');

    Route::get('/blogpage', function () {
        return view('blog');
    })->name('frontend.blog');

    Route::get('/contactpage', function () {
        return view('contact');
    })->name('frontend.contact');
   
    Route::get('/testimonialspage',[TestimonialController::class,'index2'])->name('frontend.testimonials');
  
 
    Route::get('/listingpage',[CarController::class,'index2'])->name('frontend.listing');
    Route::get('/singlepage/{id}',[CarController::class,'show'])->name('frontend.single');
  
    Route::post('recivedmessage',[MessageController::class,'store'])->name('admin.newmessage');
});

/** end pages */
/**start admin*/

Route::prefix('admin')->middleware('admin')->group(function () {
   
    
    Route::get('usershow',[UserController::class,'index'])->name('admin.user');
    Route::get('/adduser',[userController::class,'create'])->name('adduser');
    Route::post('/newuser',[UserController::class,'store'])->name('admin.adduser');
    Route::get('deleteuser/{id}',[UserController::class,'destroy']);
    Route::get('edituser/{id?}',[UserController::class,'edit'])->name('admin.edituser');
    Route::put('updateuser/{id?}',[UserController::class,'update'])->name('admin.updateuser');
  
 

    // Route::get('/edituser/{id}', function () {
    //     return view('admin.edituser');
    // })->name('admin.edituser');
    Route::get('categories',[CategoryController::class,'index'])->name('admin.categories');
    Route::get('/addcategories',[CategoryController::class,'create'])->name('admin.addcategories');
    Route::post('/admin.newcategories',[CategoryController::class,'store'])->name('admin.newcategories');
    Route::get('deletecategory/{id}',[CategoryController::class,'destroy']);

    Route::get('editcategory/{id?}',[CategoryController::class,'edit'])->name('admin.editcategory');
    Route::put('updatecategory/{id?}',[CategoryController::class,'update'])->name('admin.updatecategory');
  

    Route::get('carshow',[CarController::class,'index'])->name('admin.car');
    Route::get('/addcar',[CarController::class,'create'])->name('addcar');
    Route::post('/newcar',[CarController::class,'store'])->name('admin.newcar');
    Route::get('deletecar/{id}',[CarController::class,'destroy']);
    Route::get('editcar/{id?}',[CarController::class,'edit'])->name('admin.editcar');
    Route::put('updatecar/{id?}',[CarController::class,'update'])->name('admin.updatecar');
  
 
    Route::get('edittestimonials/{id?}',[TestimonialController::class,'edit'])->name('admin.edittestimonials');
    Route::put('updatetestimonials/{id?}',[TestimonialController::class,'update'])->name('admin.updatetestimonials');
  
    Route::get('/testimonials',[TestimonialController::class,'index'])->name('admin.testimonials');

    Route::get('/addtestimonial',[TestimonialController::class,'create'])->name('admin.addtestimonial');
    Route::post('/addtestimonial',[TestimonialController::class,'store'])->name('admin.newtestimonial');
    Route::get('deletetestimonial/{id}',[TestimonialController::class,'destroy']);
    Route::get('/messages', function () {
        return view('admin.messages');
    })->name('admin.messages');

   
    Route::get('/showmessage',[MessageController::class,'index'])->name('admin.showmessage');
    Route::get('/messages',[MessageController::class,'create'])->name('admin.messageslist');
    Route::get('showmessage/{id}',[MessageController::class,'show']);
    
    
    Route::get('deletemesssage/{id}',[MessageController::class,'destroy']);
    

});


/**end admin*/


Auth::routes(['verify'=>true]);

// Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class,'logout'])->name('logout');