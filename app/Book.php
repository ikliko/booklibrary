<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Image;
use Auth;

class Book extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'cover',
        'author',
        'pages',
        'resume',
        'format',
        'publish',
        'isbn',
        'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public static function createNew($data) {
        $data['user_id'] = Auth::user()->id;
        $rules = self::rules();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'error' => [
                    'type' => 'validation',
                    'messages' => $validator
                ]
            ];
        }
        try {
            $book = new Book();
            $book->title = $data['title'];
            if (isset($data['cover'])) {
                if ($book->cover_large) {
                    $large = Image::make($book->cover_large);
                    $large->destroy();
                    $normal = Image::make($book->cover_normal);
                    $normal->destroy();
                }
                $book->cover_large = self::saveImage($data['cover'], 391, 564, 'lg');
                $book->cover_normal = self::saveImage($data['cover'], 188, 271, 'nm');
            }
            $book->author = $data['author'];
            $book->pages = $data['pages'];
            $book->resume = $data['resume'];
            $book->format = $data['format'];
            $book->publish = $data['publish'];
            $book->isbn = $data['isbn'];
            $book->user_id = array_key_exists('user_id', $data) ? $data['user_id'] : '';
            if (array_key_exists('is_accepted', $data)) $book->is_accepted = $data['is_accepted'];
            $book->save();
        } catch (\Error $exception) {
            return [
                'error' => [
                    'type' => 'saving',
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString()
                ]
            ];
        }

        return [
            'error' => [
                'type' => 'no'
            ],
            'success' => [
                'message' => 'You successfully added new book. Your book will be add in store if admin accept it'
            ]
        ];
    }

    public static function rules($isUpdate = false, $key = null) {
        $rules = [
            'title' => 'required|max:255',
            'cover' => 'required',
            'author' => 'required',
            'pages' => 'required|integer',
            'resume' => 'required',
            'format' => 'required|integer',
            'publish' => 'required|date_format:Y-m-d',
            'isbn' => 'required|between:10,255',
            'user_id' => 'required|exists:users,id'
        ];
        if ($isUpdate) {
            $rules['id'] = 'required|exists:books,id';
            unset($rules['cover']);
        }
        if ($key) return $rules[$key];
        return $rules;
    }

    private static function saveImage($image, $width, $height, $picSize, $quality = 90) {
        $filename = uniqid('b') . '.' . $image->getClientOriginalExtension();
        $path = 'uploads/images/books/' . $picSize . '/' . $filename;
        Image::make($image)
            ->resize($width, $height)
            ->save($path, $quality);

        return $path;
    }

    public static function edit($data, $id) {
        $data['id'] = $id;
        $rules = self::rules(true);
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'error' => [
                    'type' => 'validation',
                    'messages' => $validator
                ]
            ];
        }
        try {
            $book = Book::findOrFail($id);
            $book->title = $data['title'];
            if (isset($data['cover'])) {
                if ($book->cover_large) {
                    $large = Image::make($book->cover_large);
                    $large->destroy();
                    $normal = Image::make($book->cover_normal);
                    $normal->destroy();
                }
                $book->cover_large = self::saveImage($data['cover'], 391, 564, 'lg');
                $book->cover_normal = self::saveImage($data['cover'], 188, 271, 'nm');
            }
            $book->author = $data['author'];
            $book->pages = $data['pages'];
            $book->resume = $data['resume'];
            $book->format = $data['format'];
            $book->publish = $data['publish'];
            $book->isbn = $data['isbn'];
            if (array_key_exists('is_accepted', $data)) $book->is_accepted = $data['is_accepted'];
            $book->save();
        } catch (\Error $exception) {
            return [
                'error' => [
                    'type' => 'saving',
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString()
                ]
            ];
        }

        return [
            'error' => [
                'type' => 'no'
            ],
            'success' => [
                'message' => 'You successfully added new book. Your book will be add in store if admin accept it'
            ]
        ];
    }

    public function user() {
        return $this->belongsTo('User', 'user_id');
    }

    public function favouritesCount() {
        return Favourite::bookFavouritesCount($this->id);
    }

    public function favourites() {
        return Favourite::bookFavouritesUsers($this->id);
    }

    public function accepted() {
//        var_dump($this -> is_accepted);
        return intval($this->is_accepted) === 1 ? 1 : 0;
    }
}
