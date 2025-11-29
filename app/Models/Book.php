<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category() { return $this->belongsTo(Category::class); }
    public function publisher() { return $this->belongsTo(Publisher::class); }
    public function author() { return $this->belongsTo(Author::class); }
    public function licenses() { return $this->hasMany(License::class); }

    public function availableLicenses() { return $this->licenses()->where('status', 'available'); }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($q, $search) {
            return $q->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($q, $category) {
            return $q->where('category_id', $category);
        });

        $query->when($filters['publisher'] ?? false, function($q, $publisher) {
            return $q->where('publisher_id', $publisher);
        });

        $query->when($filters['author'] ?? false, function($q, $author) {
            return $q->where('author_id', $author);
        });

        $query->when($filters['year'] ?? false, function($q, $year) {
            return $q->where('year', $year);
        });
    }
}