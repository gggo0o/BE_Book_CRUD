<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $title = $request->input('title');

        $query = Book::query();

        if ($title) {
            $query->where('title', $title);
        }

        $books = $query->whereNull('deleted_at')->get();

        return response()->json(['message' => 'Book Read Successfully!', 'book'=>$books]);
    }

    public function create()
    {
        return response()->json(['message' => 'Create Operation Not Supported Yet...'], 405);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique:books',
                'author' => 'required',
            ]);

            $book = Book::create($request->all());

            return response()->json(['message' => 'Book Created Successfully!', 'book' => $book]);
        } 
        catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } 
        catch (QueryException $e) {
            return response()->json(['message' => 'Database Error!'], 500);
        }
    }


    public function update(Request $request, Book $book)
    {
        try {
            $request->validate([
                'title' => 'required|unique:books,title,' . $book->id,
                'author' => 'required',
            ]);

            $book->update($request->all());
            $book->touch(); 

            return response()->json(['message' => 'Book Updated Successfully!', 'book' => $book]);
        } 
        catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        } 
        catch (QueryException $e) {
            return response()->json(['message' => 'Database Error!'], 500);
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();

            return response()->json(['message' => 'Book Deleted Successfully', 'deleted_book_id' => $book->id], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database Error'], 500);
        }
    }



}
