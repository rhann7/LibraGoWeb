<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['loan_date' => 'datetime', 'due_date' => 'datetime', 'returned_date' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }
    public function license() { return $this->belongsTo(License::class); }
    public function getBookAttribute() { return $this->license->book; }
}