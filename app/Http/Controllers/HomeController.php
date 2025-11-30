<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::limit(6)->get();
        $latestBooks = Book::with('author')->latest()->limit(4)->get();
        return view('home', compact('categories', 'latestBooks'));
    }
}