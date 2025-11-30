<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\License;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'username' => 'adminlibrago',
            'email'    => 'admin@email.com',
            'password' => Hash::make('password'),
            'role'     => 'admin'
        ]);
        
        User::create([
            'name'     => 'User Test',
            'username' => 'usertest',
            'email'    => 'user@email.com',
            'password' => Hash::make('password'),
            'role'     => 'user'
        ]);

        $categories = Category::factory(5)->create();
        $authors    = Author::factory(10)->create(); 
        $publishers = Publisher::factory(5)->create();

        for ($i = 0; $i < 20; $i++) {
            $book = Book::factory()->create([
                'category_id'  => $categories->random()->id,
                'author_id'    => $authors->random()->id,
                'publisher_id' => $publishers->random()->id,
            ]);

            $jumlahStok = rand(3, 5);
            for ($j = 0; $j < $jumlahStok; $j++) {
                License::create([
                    'book_id' => $book->id,
                    'status'  => 'available'
                ]);
            }
        }
    }
}