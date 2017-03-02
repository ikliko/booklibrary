<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Response;
use Zofe\Rapyd\Demo\Category;

class SearchController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Retrieve the user's input and escape it
        $query = e(Input::get('q', ''));

        // If the input is empty, return an error response
        if (!$query && $query == '') return Response::json(array('data' => []), 404);

        $products = Book::whereIsAccepted(1)
            ->where('title', 'like', '%' . $query . '%')
            ->orderBy('title', 'asc')
            ->take(5)
            ->get()
            ->toArray();

        // Add type of data to each item of each set of results
        $products = $this->appendValue($products, 'product', 'class');
        $products = $this->appendURL($products, 'books');
        $products = $this->appendPicture($products);

        // Merge all data into one array
        $data = array_merge($products);

        return Response::json(array(
            'data' => $data
        ), 200);
    }

    public function appendValue($data, $type, $element) {
        // operate on the item passed by reference, adding the element and type
        foreach ($data as $key => & $item) {
            $item[$element] = $type;
        }
        return $data;
    }

    public function appendURL($data, $prefix) {
        // operate on the item passed by reference, adding the url based on slug
        foreach ($data as $key => & $item) {
            $item['url'] = url($prefix . '/' . $item['id']);
        }
        return $data;
    }

    public function appendPicture($data) {
        foreach ($data as $key => & $item) {
            $item['picture'] = url($item['cover_large']);
        }
        return $data;
    }
}
