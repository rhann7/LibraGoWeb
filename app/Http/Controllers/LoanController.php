<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function store(Book $book)
    {
        $user = Auth::user();

        $activeLoan = $user->loans()->whereNull('returned_date')->whereHas('license', fn($q) => $q->where('book_id', $book->id))->first();
        
        if ($activeLoan) {
            return view('reader.index', ['book' => $book, 'loan' => $activeLoan, 'file_url' => asset('storage/' . $book->pdf_file)]);
        }

        $license = $book->licenses()->where('status', 'available')->first();
        
        if (!$license) {
            return back()->with('error', 'Buku tidak tersedia.');
        }

        $license->update();

        $newLoan = Loan::create([
            'user_id'       => $user->id,
            'license_id'    => $license->id,
            'loan_date'     => now(),
            'due_date'      => now()->addDays(7),
            'returned_date' => null,
            'last_page'     => 1,
        ]);

        return view('reader.index', ['book' => $book, 'loan' => $newLoan, 'file_url' => asset('storage/' . $book->pdf_file)]);
    }

    public function update(Request $request, Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) abort(403);

        $request->validate(['last_page' => 'required|integer|min:1']);

        $loan->update(['last_page' => $request->last_page]);
        return response()->json(['status' => 'saved']);
    }

    public function destroy(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) abort(403);
        $loan->update(['returned_date' => now()]);
        $loan->license->update(['status' => 'available']);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dikembalikan.');
    }
}