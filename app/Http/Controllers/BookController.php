<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class BookController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $booksResponse = Book::whereIsAccepted(1)->paginate(4);
        $books = $booksResponse->getCollection()->all();
        $pages = $booksResponse->render();
        $pageData = self::getData('store', 'Store');
        $pageData['books'] = $books;
        $pageData['pages'] = $pages;
        return view('store', $pageData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Auth::check()) return redirect()->to('login');
        $pageData = self::getData('index', 'Add new book');
        return view('index', $pageData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!Auth::check()) return redirect()->to('login');
        $bookResponse = Book::createNew($request->all());
        switch ($bookResponse['error']['type']) {
            case 'validation':
                return redirect()->back()->withInput()->withErrors($bookResponse['error']['messages']);
            case 'saving':
                return redirect()->back()->withInput()->withErrors($bookResponse['error']['message']);
            default:
                flash()->success($bookResponse['success']['message']);
                return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Auth::check()) return redirect()->to('login');
        $book = Book::findOrFail($id);
        $data = self::getData('book', $book->title);
        $data['book'] = $book;
        return view('book', $data);
    }
}
