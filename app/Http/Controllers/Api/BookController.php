<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
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
        $book = Book::get();

        return response()->json([
            'status' => 1,
            'message' => 'All Books',
            'data' => $book
        ], 200);
    }

    // AUTHOR METHORD - GET
    public function authorBook()
    {
        $author_id = auth()->user()->id;
        $author_books = Author::find($author_id)->books;

        return response()->json([
            'status' => 1,
            'message' => 'Author Books',
            'data' => $author_books
        ], 200);
    }

    // SINGLE BOOKS - GET
    public function singleBook($book_id)
    {
        $author_id = Auth::user()->id;
        if (Book::where([
            'author_id' => $author_id,
            'id' => $book_id
        ])->exists()) {
            $book = Book::find($book_id);
            return response()->json([
                'status' => 1,
                'message' => 'Author Book ',
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Book not found'
            ], 404);
        }
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
