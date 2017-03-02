<?php

namespace App\Http\Controllers;

use App\Book;
use App\Favourite;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class FavouriteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Auth::check()) return redirect()->to('login');
        $booksResponse = Auth::user()->paginateFavourites(4);
        $books = $booksResponse->getCollection()->all();
        $books = self::normalizeBooks($books);
        $pages = $booksResponse->render();
        $pageData = self::getData('bookmarks', 'Bookmarks');
        $pageData['books'] = $books;
        $pageData['pages'] = $pages;
        return view('store', $pageData);
    }

    private function normalizeBooks($data) {
        $books = [];
        foreach ($data as $book) {
            $books[] = $book->book;
        }

        return $books;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!Auth::check()) return redirect()->to('login');
        $favouriteResponse = Favourite::makeFavourite($request->all());
        switch ($favouriteResponse['error']['type']) {
            case 'auth':
                flash()->warning($favouriteResponse['error']['message']);
                return redirect()->to('login');
            case 'validation':
            case 'saving':
                flash()->danger('Please try again later');
                return redirect()->back();
            default:
                flash()->success($favouriteResponse['success']['message']);
                return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Favourite::destroy($id);
        flash()->success('Your bookmark has been deleted');
        return redirect()->back();
    }
}
