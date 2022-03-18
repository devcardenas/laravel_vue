<?php

namespace Database\Seeders;

use App\Models\BookOnLoan;
use Illuminate\Database\Seeder;

class BookOnLoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 1,
            'user_id' => 2,
            'return_date' => null,
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 2,
            'user_id' => 2,
            'return_date' => null,
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 3,
            'user_id' => 2,
            'return_date' => null,
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 4,
            'user_id' => 2,
            'return_date' => null,
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 5,
            'user_id' => 2,
            'return_date' => null,
        ]);

    }
}
