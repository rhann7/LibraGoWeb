<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $stats = [
                'total_books'      => Book::count(),
                'total_users'      => User::count(),
                'total_categories' => Category::count(),
                'active_loans'     => Loan::whereNull('returned_date')->count()
            ];

            $recentActivities = Loan::with(['user', 'license.book'])->latest('loan_date')->take(5)->get();

            $popularBooks = Book::withCount('licenses')->withCount(['licenses as borrowed_count' => function($q) {
                $q->whereHas('loan');
            }])->orderByDesc('borrowed_count')->take(3)->get();

            return view('dashboards.admin', compact('stats', 'recentActivities', 'popularBooks'));
        }

        $currentRead = $user->loans()->with('license.book.author')->whereNull('returned_date')->latest('loan_date')->first();

        $myStats = [
            'books_read' => $user->loans()->whereNotNull('returned_date')->count(),
            'bookmarks'  => $user->bookmarks()->count(),
            'favorites'  => $user->favorites()->count()
        ];

        $recentHistories = $user->loans()->with('license.book')->whereNotNull('returned_date')->latest('returned_date')->take(4)->get();

        $wishlist = $user->wishlists()->with('author')->take(3)->get();

        return view('dashboards.user', compact('currentRead', 'myStats', 'recentHistories', 'wishlist'));
    }
}