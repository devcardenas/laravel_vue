<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookOnLoan;
use Illuminate\Http\Request;

class BookController extends Controller
{

    /*public function __construct()
    {
    $this->middleware(['role:administrativo','permission:view_books|create_books|edit_books|delete_books|view_books_loans']);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => Book::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create($request->all());

        if (!empty($book)) {
            return response()->json([
                'data' => [
                    "error" => false,
                    'book' => $book,
                    'message' => 'Book created successfully',
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    'message' => 'Book could not be created',
                ],
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!empty($book)) {
            if ($book->update($request->all())) {
                return response()->json([
                    'data' => [
                        "error" => false,
                        "message" => "Book updated successfully",
                        "book" => $book,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        "error" => true,
                        "message" => "Book could not be updated",
                    ],
                ], 200);
            }
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    "message" => "Book could not be found",
                ],
            ], 200);
        }
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if (!empty($book)) {
            return response()->json([
                'data' => [
                    "error" => false,
                    "book" => $book,
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    "message" => "Book could not be found",
                ],
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        // The book is deleted only if it has no book_on_loan records
        if (!empty($book)) {
            try {
                if ($book->delete()) {
                    return response()->json([
                        'data' => [
                            "error" => false,
                            "message" => "Book deleted successfully",
                            "book" => $book,
                        ],
                    ], 200);
                } 
            } catch (\Throwable $th) {
                return response()->json([
                    'data' => [
                        "error" => true,
                        "message" => "Book in loan, could not be deleted",
                    ],
                ], 200);
            }
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    "message" => "Book could not be found",
                ],
            ], 400);
        }
    }

    // Get the books that are on loan
    public function getBooksOnLoan()
    {
        $books = BookOnLoan::with("book")->with("user")->where('return_date', null)->get();

        if (!empty($books)) {
            return response()->json([
                'data' => [
                    "error" => false,
                    "message" => "Books on loan",
                    "books" => $books,
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    "message" => "No books on loan",
                ],
            ], 200);
        }
    }
}
