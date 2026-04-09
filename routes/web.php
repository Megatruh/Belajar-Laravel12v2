<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Support\Facades\Route;


Route::get('/', function (Posts $posts) {
    return view('home', [
        'title'=> 'Home Page',
        'posts' => $posts
    ]); // Passing data ke view - $title untuk judul halaman
});

Route::get('/blog', function () {
    $posts = Posts::filter(request(['keyword', 'category', 'author', 'city']))->paginate(9)->withQueryString();

    return view('blog', ['title' => 'Blog Page', 'posts' => $posts]);
});

Route::get( '/blog/{posts:slug}', function (Posts $posts){

    return view( 'post', [
        'title' => $posts['title'],
        'post' => $posts
    ]);

});


Route::get( '/blog?city={city}', function ($city){
    // $posts = Posts::where('city', $city)->with(['category', 'author'])->get();
    // return view( 'blog', [
    //     'title' => $posts->count() . ' Articles on '. $city,
    //     'posts' => $posts
    // ]);

    $posts = Posts::where('city', $city)->get();
    return view( 'blog', [
        'title' => $posts->count() . ' Articles on '. $city,
        'posts' => $posts
    ]);

});

Route::get( '/date/{date}', function ($date){

    // $posts = Posts::where('date', $date)->with(['category', 'author'])->get();

    // return view( 'blog', [
    //     'title' => $posts->count() . ' Articles on '. $date,
    //     'posts' => $posts
    // ]);

    $posts = Posts::where('date', $date)->get();

    return view( 'blog', [
        'title' => $posts->count() . ' Articles on '. $date,
        'posts' => $posts
    ]);
});

Route::get( '/blog?category={category:slug}', function (Category $category){

    // $posts = Posts::where('category_id', $category->id)->with(['category', 'author'])->get();

    // return view( 'blog', [
    //     'title' => $posts->count() . ' Articles About '. $category->name,
    //     'posts' => $posts
    // ]);

    $posts = Posts::where('category_id', $category->id)->get();

    return view( 'blog', [
        'title' => $posts->count() . ' Articles About '. $category->name,
        'posts' => $posts
    ]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Us']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
