<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create(
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter has lived under the stairs at his aunt and uncle\'s house his whole life. But on his 11th birthday, he learns he\'s a powerful wizard -- with a place waiting for him at the Hogwarts School of Witchcraft and Wizardry. As he learns to harness his newfound powers with the help of the school\'s kindly headmaster, Harry uncovers the truth about his parents\' deaths -- and about the villain who\'s to blame.',
                'borrowed' => true,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Chamber of Secrets',
                'author' => 'J.K. Rowling',
                'description' => 'The Dursleys were so mean and hideous that summer that all Harry Potter wanted was to get back to the Hogwarts School for Witchcraft and Wizardry. But just as he\'s packing his bags, Harry receives a warning from a strange, impish creature named Dobby who says that if Harry Potter returns to Hogwarts, disaster will strike.',
                'borrowed' => true,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Prisoner of Azkaban',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter has escaped his Dementors prison and now must face new challenges at Hogwarts School of Witchcraft and Wizardry. As he learns about the terrible evil behind the scenes at Hogwarts, Harry comes to realize that his greatest enemy is not the Dementors but a new creature named the dark lord, Voldemort, who has risen from the dead to take the world.',
                'borrowed' => true,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Goblet of Fire',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter is midway through his training as a wizard and his coming of age. Harry wants to get away from the pernicious Dursleys and go to the International Quidditch Cup. He wants to find out about the mysterious event thats supposed to take place at Hogwarts this year, an event involving two other rival schools of magic, and a competition that hasn\'t happened for a hundred years. He wants to be a normal, fourteen-year-old wizard. But unfortunately for Harry Potter, he\'s not normal - even by wizarding standards.',
                'borrowed' => true,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Order of the Phoenix',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter has escaped his Dementors prison and now must face new challenges at Hogwarts School of Witchcraft and Wizardry. As he learns about the terrible evil behind the scenes at Hogwarts, Harry comes to realize that his greatest enemy is not the Dementors but a new creature named the dark lord, Voldemort, who has risen from the dead to take the world.',
                'borrowed' => true,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Half-Blood Prince',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter has escaped his Dementors prison and now must face new challenges at Hogwarts School of Witchcraft and Wizardry. As he learns about the terrible evil behind the scenes at Hogwarts, Harry comes to realize that his greatest enemy is not the Dementors but a new creature named the dark lord, Voldemort, who has risen from the dead to take the world.',
                'borrowed' => false,
            ]
        );
        Book::create(
            [
                'title' => 'Harry Potter and the Deathly Hallows',
                'author' => 'J.K. Rowling',
                'description' => 'Harry Potter is midway through his training as a wizard and his coming of age. Harry wants to get away from the pernicious Dursleys and go to the International Quidditch Cup. He wants to find out about the mysterious event thats supposed to take place at Hogwarts this year, an event involving two other rival schools of magic, and a competition that hasn\'t happened for a hundred years. He wants to be a normal, fourteen-year-old wizard. But unfortunately for Harry Potter, he\'s not normal - even by wizarding standards.',
                'borrowed' => false,
            ]
        );
        Book::create(
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The Hobbit, or There and Back Again, is a children\'s fantasy novel written by English author J.R.R. Tolkien. It was first published on 21 September 1937 as part of the long-running canon of English literature, and has been adapted into a number of other languages, including French, Italian, German, Russian, and Spanish.',
                'borrowed' => false,
            ]
        );
        Book::create(
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The Lord of the Rings is a fantasy novel written by English author J.R.R. Tolkien. The story began as a sequel to Tolkien\'s 1937 fantasy novel The Hobbit, but eventually developed into a much larger work. Written in stages between 1937 and 1949, The Lord of the Rings is one of the best-selling novels in the English language, with over 150 million copies sold.',
                'borrowed' => false,
            ]
        );
        Book::create(
            [
                'title' => 'The Hobbit: An Unexpected Journey',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The Hobbit, or There and Back Again, is a children\'s fantasy novel written by English author J.R.R. Tolkien. It was first published on 21 September 1937 as part of the long-running canon of English literature, and has been adapted into a number of other languages, including French, Italian, German, Russian, and Spanish.',
                'borrowed' => false,
            ]
        );
        Book::create(
            [
                'title' => 'The Hobbit: The Desolation of Smaug',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The Hobbit, or There and Back Again, is a children\'s fantasy novel written by English author J.R.R. Tolkien. It was first published on 21 September 1937 as part of the long-running canon of English literature, and has been adapted into a number of other languages, including French, Italian, German, Russian, and Spanish.',
                'borrowed' => false,
            ]
        );
    }
}
