<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingBook = Book::where('title', 'Sample Book 1-C')->first();

        if (!$existingBook) {
            logger(0);
            DB::table('books')->insert([
                'title' => 'Sample Book 1-C',
                'author' => 'John Doe',
                'description' => null,
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null,
            ]);
        }
        else if($existingBook){logger(1);}
    
        logger(0010);
        DB::table('books')->insert([
            'title' => 'Sample Book 2-U',
            'author' => 'Jane Smith',
            'description' => null,
            'created_at' => now(),
            'updated_at' => '2023-09-26',
            'deleted_at' => null,
        ]);
        
        logger(0011);
        DB::table('books')->insert([
            'title' => 'Sample Book 3-D',
            'author' => 'Jane Smith',
            'description' => null,
            'created_at' => now(),
            'updated_at' => '2023-09-26',
            'deleted_at' => '2024-03-21',
        ]);

    }
}
