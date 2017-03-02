<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpSpec\Exception\Exception;
use Auth;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract {
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password'
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

    public static function edit($data) {
        $validator = Validator::make(
            $data,
            self::rules('edit'),
            self::messages('edit')
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
            $user = Auth::user();
            $user->username = $data['username'];
            $user->save();
        } catch (\Exception $exception) {
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
                'message' => 'Your profile was edited successfully',
            ]
        ];
    }

    /***
     * Use this function to get rules for database.
     * To get rules for update set first param to true.
     * If you want to get current key set second parameter to get current rule key.
     *
     * @param bool $isUpdate - by default is false set to true if you want rules for update database
     * @param null $key - set key as string if you want to get selected rule
     * @return array - retunrs all rules or selected key
     */
    public static function rules($option = 'none', $key = null) {
        $rules = [
            'username' => 'required|between:4,255|alpha_num|unique:users,username'
        ];

        switch ($option) {
            case 'register':
                $rules['password'] = 'required|between:6,255';
                $rules['confirm_password'] = 'required|same:password';
                break;
            case 'change-password':
                unset($rules);
                $rules['password'] = 'required|between:6,255';
                $rules['new_password'] = 'required|between:6,255';
                $rules['confirm_password'] = 'required|same:new_password';
                break;
        }

        if ($key) return $rules[$key];
        return $rules;
    }

    public static function messages($option = 'none', $key = null) {
        $messages = [
            'username.required' => 'username is required',
            'username.between' => 'username is between',
            'username.alpha_num' => 'username specia chars',
        ];

        switch ($option) {
            case 'register':
                $messages['password.required'] = 'pass required';
                $messages['password.between'] = 'pass between';
                $messages['confirm_password.required'] = 'confirm pass pls';
                $messages['confirm_password.same'] = 'passwords does not match';
                break;
            case 'change-password':
                $messages['password.required'] = 'pass required';
                $messages['password.between'] = 'pass between';
                $messages['new_password.required'] = 'pass required';
                $messages['new_password.between'] = 'pass between';
                $messages['confirm_password.required'] = 'confirm pass pls';
                $messages['confirm_password.same'] = 'passwords does not match';
                break;
        }

        if ($key) return $messages[$key];
        return $messages;
    }

    public static function register($data) {
        $validator = Validator::make(
            $data,
            self::rules('register'),
            self::messages('register')
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
            $user = new User();
            $user->username = $data['username'];
            $user->password = Hash::make($data['password']);
            $user->save();
        } catch (\Exception $exception) {
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
                'message' => 'You are registered successfully.',
                'data' => $user
            ]
        ];
    }

    public function books() {
        return $this->hasMany('\App\Book', 'user_id');
    }

    public function paginateBooks($number) {
        return Book::whereUserId(Auth::user()->id)->paginate($number);
    }

    public function isFavourite($book_id) {
        return Favourite::isFavourite($book_id);
    }

    public function currentFavourite($book_id) {
        return Favourite::getCurrent($book_id);
    }

    public function favourites() {
        return Favourite::authFavourites();
    }

    public function paginateFavourites($count) {
        return Favourite::whereUserId(Auth::user()->id)->paginate($count);
    }

    public function changePassword($data) {
        if (!Auth::check()) {
            return [
                'error' => [
                    'type' => 'auth',
                    'message' => 'You are not logged in'
                ]
            ];
        }
        $validator = Validator::make(
            $data,
            self::rules('change-password'),
            self::messages('change-password')
        );
        if ($validator->fails()) {
            return [
                'error' => [
                    'type' => 'validation',
                    'messages' => $validator
                ]
            ];
        }
        if (!Hash::check($data['password'], Auth::user()->password)) {
            $validator->errors()->add('password', 'Password is incorrect!');
            return [
                'error' => [
                    'type' => 'password',
                    'messages' => $validator
                ]
            ];
        }
        try {
            $user = Auth::user();
            $user->password = Hash::make($data['new_password']);
            $user->save();
        } catch (\Exception $exception) {
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
                'message' => 'Your password has been changed successfully',
            ],
        ];
    }
}