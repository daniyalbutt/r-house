<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\{Comment,Category, Product, Page, Blog, Faq, Banner, Partner};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banner::where('status',0)->get();
        $categories = Category::where('parent_id',0)->get();
        $featured = Product::where('featured', 1)->get();
        $trendingProducts = Product::where('trending',1)->get();
        $dealProducts = Product::where('deals',1)->get();
        $page = Page::where('slug','home')->first();
        return view('welcome',compact('categories','trendingProducts','dealProducts','page', 'banners', 'featured'));
    }

    public function about()
    {
        $page = Page::where('slug','about-us')->first();
        return view('about',compact('page'));
    }

    public function contact()
    {
        $page = Page::where('slug','contact')->first();
        return view('contact',compact('page'));
    }

    public function blogs()
    {
        $page = Page::where('slug','blogs')->first();
        $blogs = Blog::all();
        return view('blogs',compact('page','blogs'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('slug','privacy-policy')->first();
        return view('privacy',compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug','terms-conditions')->first();
        return view('terms',compact('page'));
    }

}
