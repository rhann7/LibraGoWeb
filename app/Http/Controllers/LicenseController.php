<?php

namespace App\Http\Controllers;

use App\Models\License;

class LicenseController extends Controller
{
    public function destroy(License $license)
    {
        if ($license->status === 'borrowed') {
            return back()->with('error', 'Gagal hapus. Lisensi ini sedang dipinjam oleh user.');
        }

        $license->delete();
        return back()->with('success', 'Satu lisensi berhasil dihapus.');
    }
}