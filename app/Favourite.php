<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Validator;

class Favourite extends Model {
    public static $rules = [
        'user_id' => 'exists:users,id',
        'book_id' => 'exists:books,id',
    ];
    public static $messages = [
        'user_id.exists' => 'User does not exists',
        'book_id.exists' => 'Book does not exists',
    ];
    protected $table = 'favourites';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
    ];

    public static function authFavourites() {
        return Favourite::whereUserId(Auth::user()->id)->get();
    }

    public static function bookFavouritesCount($book_id) {
        return Favourite::whereBookId($book_id)->count();
    }

    public static function bookFavouritesUsers($book_id) {
        return Favourite::whereBookId($book_id)->get();
    }

    public static function isFavourite($book_id) {
        return Favourite::whereBookId($book_id)
            ->whereUserId(Auth::user()->id)
            ->count();
    }

    public static function getCurrent($book_id) {
        return Favourite::whereBookId($book_id)
            ->whereUserId(Auth::user()->id)
            ->firstOrFail();
    }

    public static function makeFavourite($data) {
        if (!Auth::check()) {
            return [
                'error' => 'auth',
                'message' => 'You are not logged in'
            ];
        }
        $data['user_id'] = Auth::user()->id;
        $validator = Validator::make(
            $data,
            self::$rules,
            self::$messages
        );
        if ($validator->fails()) {
            return [
                'error' => [
                    'type' => 'validation',
                    'messages' => $validator
                ]
            ];
        }
        try {
            $favourite = new Favourite();
            $favourite->user_id = $data['user_id'];
            $favourite->book_id = $data['book_id'];
            $favourite->save();
        } catch (\Exception $ex) {
            return [
                'error' => [
                    'type' => 'saving',
                    'messages' => $ex->getMessage(),
                    'trace' => $ex->getTraceAsString()
                ]
            ];
        }
        return [
            'error' => [
                'type' => 'none'
            ],
            'success' => [
                'message' => 'Successfully added to favourites'
            ]
        ];
    }

    public static function removeBookmark($bookmark_id) {

    }

    public function book() {
        return $this->belongsTo('\App\Book', 'book_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
