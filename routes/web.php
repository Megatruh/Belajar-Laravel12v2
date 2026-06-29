<?php

use App\Http\Controllers\PostDashboardController;
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
    $posts = Posts::query()->where('city', $city)->get();
    return view( 'blog', [
        'title' => $posts->count() . ' Articles on '. $city,
        'posts' => $posts
    ]);

});

Route::get( '/date/{date}', function ($date){

    $posts = Posts::query()->where('date', $date)->get();

    return view( 'blog', [
        'title' => $posts->count() . ' Articles on '. $date,
        'posts' => $posts
    ]);
});

Route::get( '/blog?category={category:slug}', function (Category $category){

    $posts = Posts::query()->where('category_id', $category->id)->get();

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


Route::middleware('auth')->group(function () {
    // urus crud posts
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        // tampilan tabel data
        Route::get('/', [PostDashboardController::class, 'index'])->name('index');
        // tambah data post
        Route::get('/create', [PostDashboardController::class, 'create'])->name('create');
        // tampilan show post
        Route::get('/{post:slug}', [PostDashboardController::class, 'show'])->name('show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
