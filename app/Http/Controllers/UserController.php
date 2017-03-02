<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Auth::check()) return redirect()->to('login');
        $booksResponse = Auth::user()->paginateBooks(4);
        $books = $booksResponse->getCollection()->all();
        $pages = $booksResponse->render();
        $pageData = self::getData('profile', 'Profile');
        $pageData['books'] = $books;
        $pageData['pages'] = $pages;
        return view('store', $pageData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $userResponse = User::register($request->all());
        switch ($userResponse['error']['type']) {
            case 'validation':
                return redirect()->back()->withInput()->withErrors($userResponse['error']['messages']);
            case 'saving':
                flash()->error('Sorry, registration is not successfully. Try again later.');
                return redirect()->back();
            default:
                flash()->success('You are registered successfully!');
                return redirect()->to('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        if (!Auth::check()) return redirect()->to('login');
        $pageData = self::getData('edit');
        return view('profile-edit', $pageData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $updateResponse = Auth::user()->edit($request->all());
        switch ($updateResponse['error']['type']) {
            case 'auth':
                flash()->success($updateResponse['error']['message']);
                return redirect()->to('login');
            case 'validation';
                return redirect()->back()->withInput()->withErrors($updateResponse['error']['messages']);
            case 'saving':
                return redirect()->back()->withInput();
            default:
                return redirect()->back();
        }
    }

    public function login() {
        $pageData = self::getData('login');
        return view('login', $pageData);
    }

    public function doLogin(Request $request) {
        $data = $request->all();
        if (!Auth::attempt(array('username' => $data['username'], 'password' => $data['password']), isset($data['remember']))) {
            flash()->error('Invalid login data.');
            return redirect()->back()->withInput();
        }
        flash()->success('You have been logged in.');
        return redirect()->to('/');
    }

    public function logout() {
        if (!Auth::check()) return redirect()->to('profile');
        Auth::logout();
        flash()->success('You have been logged out.');
        return redirect()->to('login');
    }

    public function changePassword(Request $request) {
        if (!Auth::check()) return redirect()->to('/login');
        $passwordChangeResponse = Auth::user()->changePassword($request->all());
//        var_dump($passwordChangeResponse['error']['type']);
        switch ($passwordChangeResponse['error']['type']) {
            case 'validation':
            case 'password':
                return redirect()->back()->withErrors($passwordChangeResponse['error']['messages']);
            case 'saving':
                return redirect()->back()->withErrors($passwordChangeResponse['error']['message']);
            default:
                flash()->success($passwordChangeResponse['success']['message']);
                return redirect()->back();
        }
    }
}
