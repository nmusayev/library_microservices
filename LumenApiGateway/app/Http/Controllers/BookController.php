<?php

namespace App\Http\Controllers;

use App\Book;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        //
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return list of books
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Create one new author
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse($this->bookService
            ->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one author
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($book)
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    /**
     * Update an existing author
     * @param Request $request
     * @param $book
     */
    public function update($book, Request $request)
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * Deleting given author
     * @param $book
     */
    public function destroy($book)
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}
