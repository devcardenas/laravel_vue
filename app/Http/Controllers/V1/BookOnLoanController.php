<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookOnLoan;
use Illuminate\Http\Request;

class BookOnLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            [
                'data' => BookOnLoan::with("book")->where('user_id', auth()->user()->id)->where('return_date', null)->get(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $bookOnLoan = BookOnLoan::create($data);

        if (!empty($bookOnLoan)) {
            Book::where('id', $data['book_id'])->update(['borrowed' => true]);
            return response()->json([
                'data' => [
                    "error" => false,
                    'response' => $bookOnLoan,
                    'message' => 'Book borrowed successfully',
                ]
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    'message' => 'Can not process the request',
                ]
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
        $bookOnLoan = BookOnLoan::where('user_id', auth()->user()->id)->where('book_id', $id)->first();
        $data = $request->all();
        $data['return_date'] = date('Y-m-d H:i:s');

        if (!empty($bookOnLoan)) {
            $bookOnLoan->where('user_id', auth()->user()->id)->where('book_id', $id)->update($data);
            Book::where('id', $id)->update(['borrowed' => false]);

            return response()->json([
                'data' => [
                    "error" => false,
                    'response' => $bookOnLoan,
                    'message' => 'Book returned successfully',
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "error" => true,
                    'message' => 'Can not retrieve the book on loan',
                ]
            ], 400);
        }
    }
}
