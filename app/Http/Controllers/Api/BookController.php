<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // CREATE METHORD - POST
    public function createBook(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required',
            'book_cost' => 'required',
        ]);

        // Create Book Data
        $book = new Book();
        $book->authod_id = Auth::user()->id;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->book_cost = $request->book_cost;
        $book->save();

        // Send Response
        return response()->json([
            'status' => 1,
            'message' => 'Book Create successfully'

        ], 200);
    }

    // LIST METHORD - GET
    public function listBook()
    {
    }

    // SINGLE BOOKS - GET
    public function singleBook($book_id)
    {
    }

    // UPDATE METHORD - POST
    public function updateBook(Request $request, $book_id)
    {
    }

    // DELETE METHORD - GET
    public function deleteBook($book_id)
    {
    }
}
