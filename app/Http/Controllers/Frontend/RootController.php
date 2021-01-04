<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class RootController extends Controller
{
    public function index(){
    	$categories = Category::orderBy('category_name', 'ASC')->get();
    	return view("FrontendViews.index", compact('categories'));
    }
}
