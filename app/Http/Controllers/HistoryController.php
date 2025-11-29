<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Auth::user()->loans()->with(['license.book.category', 'license.book.author'])->whereNotNull('returned_date')->latest('returned_date')->paginate(12);
        return view('history.index', compact('histories'));
    }

    public function show(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Ini bukan riwayat baca kamu!');
        }

        if ($loan->returned_date === null) {
            return redirect()->route('loans.store', $loan->license->book->slug)->with('info', 'Buku ini sedang dibaca, diarahkan ke Reader.');
        }

        $loan->load(['license.book.category', 'license.book.author', 'license.book.publisher']);
        
        $duration = $loan->loan_date->diffForHumans($loan->returned_date, [
            'syntax' => CarbonInterface::DIFF_ABSOLUTE, 'parts' => 2
        ]);

        return view('history.show', compact('loan', 'duration'));
    }
}