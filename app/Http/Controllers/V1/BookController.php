<?php

namespace App\Http\Controllers\V1;

use App\Models\Book;
use App\Models\BookOnLoan;
use App\Http\Controllers\Controller;
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
        return Book::all();
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

        if(!empty($book)){
            return response()->json([
                "error" => false,
                'response' => $book
            ], 200);
        }else{
            return response()->json([
                "error" => true,
                'message' => 'Book could not be created'
            ], 400);
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

        if(!empty($book))
        {
            if($book->update($request->all())){
                return response()->json([
                    "error" => false,
                    "response" => "Book updated successfully",
                    "data" => $book
                ], 200);
            }else{
                return response()->json([
                    "error" => true,
                    "message" => "Book could not be updated"
                ], 400);
            }
        }
        else{
            return response()->json([
                "error" => true,
                "message" => "Book could not be found"
            ], 400);
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

        if(!empty($book))
        {
            if($book->delete()){
                return response()->json([
                    "error" => false,
                    "response" => "Book deleted successfully",
                    "data" => $book
                ], 200);
            }else{
                return response()->json([
                    "error" => true,
                    "message" => "Book could not be deleted"
                ], 400);
            }
        }
        else{
            return response()->json([
                "error" => true,
                "message" => "Book could not be found"
            ], 400);
        }
    }

    // Get the books that are on loan
    public function getBooksOnLoan()
    {
        $books = BookOnLoan::with("book")->with("user")->where('return_date', null)->get();

        if(!empty($books))
        {
            return response()->json([
                "error" => false,
                "response" => "Books on loan",
                "data" => $books
            ], 200);
        }
        else{
            return response()->json([
                "error" => true,
                "message" => "No books on loan"
            ], 400);
        }
    }
}
