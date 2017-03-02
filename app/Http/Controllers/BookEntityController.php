<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class BookEntityController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Auth::check()) return redirect()->to('panel/login');
        return view('panel.books-table', [
            'books' => Book::all()
        ]);
    }

    public function accepted() {
        if (!Auth::check()) return redirect()->to('panel/login');
        return view('panel.books-table', [
            'books' => Book::whereIsAccepted(1)->get()
        ]);
    }

    public function pending() {
        if (!Auth::check()) return redirect()->to('panel/login');
        return view('panel.books-table', [
            'books' => Book::whereIsAccepted(0)->get()
        ]);
    }

    public function declined() {
        if (!Auth::check()) return redirect()->to('panel/login');
        return view('panel.books-table', [
            'books' => Book::whereIsAccepted(-1)->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if (!Auth::check()) return redirect()->to('panel/login');
        return view('panel.book', [
            'book' => Book::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!Auth::check()) return redirect()->to('panel/login');
        $formats = [];
        for ($i = 1; $i < 10; $i++) $formats[$i] = 'A' . $i;
        return view('panel.book-edit', [
            'book' => Book::findOrFail($id),
            'formats' => $formats
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!Auth::check()) return redirect()->to('panel/login');
        $bookResponse = Book::edit($request->all(), $id);
        switch ($bookResponse['error']['type']) {
            case 'validation':
                return redirect()->back()->withInput()->withErrors($bookResponse['error']['messages']);
            case 'saving':
                return redirect()->back()->withInput();
            default:
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
        if (!Auth::check()) return redirect()->to('panel/login');
        Book::destroy($id);
        return redirect()->back();
    }
}
