<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Currency;

class CategoryController extends Controller
{
    public function get_categories_currencies(){
        if (!\Request::ajax()) {
            return abort(404);
        }
        $get_categories = Category::orderBy('category_name', 'ASC')->get();
        $get_currencies = Currency::orderBy('currency_id', 'ASC')->get();
        return response()->json(['get_categories'=>$get_categories, 'get_currencies'=>$get_currencies], 200);
    }
}
