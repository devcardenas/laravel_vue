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
            'user_id' => 1,
            'loan_date' => '2022-01-01',
            'return_date' => '2022-01-15',
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 2,
            'user_id' => 1,
            'loan_date' => '2022-01-01',
            'return_date' => '2022-01-15',
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 3,
            'user_id' => 1,
            'loan_date' => '2022-01-01',
            'return_date' => '2022-01-15',
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 4,
            'user_id' => 1,
            'loan_date' => '2022-01-01',
            'return_date' => '2022-01-15',
        ]);

        // Create a book on loan
        BookOnLoan::create([
            'book_id' => 5,
            'user_id' => 1,
            'loan_date' => '2022-01-01',
            'return_date' => '2022-01-15',
        ]);

    }
}
