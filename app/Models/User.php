<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array { return ['password' => 'hashed']; }

    public function loans() { return $this->hasMany(Loan::class); }
    public function bookmarks() { return $this->hasMany(Bookmark::class); }
    public function favorites() { return $this->belongsToMany(Book::class, 'favorites', 'user_id', 'book_id')->withTimestamps(); }
    public function wishlists() { return $this->belongsToMany(Book::class, 'wishlists', 'user_id', 'book_id')->withTimestamps(); }
    
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isUser(): bool { return $this->role === 'user'; }
    public function hasActiveLoan(int $bookId) { return $this->loans()->whereNull('returned_date')->whereHas('license', fn($q)=> $q->where('book_id', $bookId))->exists(); }
}