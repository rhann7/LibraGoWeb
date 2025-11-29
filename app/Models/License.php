<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book() { return $this->belongsTo(Book::class); }
    public function loan() { return $this->hasOne(Loan::class)->whereNull('returned_date'); }
}