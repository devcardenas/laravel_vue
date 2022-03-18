<?php

namespace App\Http\Controllers\V1;

use App\Models\BookOnLoan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookOnLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookOnLoan::where('user_id', auth()->user()->id)->where('return_date', null)->get();
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

        if(!empty($bookOnLoan)){
            return response()->json([
                "error" => false,
                'response' => $bookOnLoan
            ], 200);
        }else{
            return response()->json([
                "error" => true,
                'message' => 'Can not process the request'
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

        if(!empty($bookOnLoan)){
            $bookOnLoan->where('user_id', auth()->user()->id)->where('book_id', $id)->update($data);

            return response()->json([
                "error" => false,
                'response' => $bookOnLoan
            ], 200);
        }else{
            return response()->json([
                "error" => true,
                'message' => 'Can not retrieve the book on loan'
            ], 400);
        }
    }
}
