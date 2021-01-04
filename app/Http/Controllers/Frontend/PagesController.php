<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;

class PagesController extends Controller
{
    public function search(Request $request){
    	$categories = Category::orderBy('category_name', 'ASC')->get();

    	if ($request->q == '') {
    		return redirect()->route('root_page');
    	}
    	$query = Ad::query();
    	$query->where('title', 'LIKE', "%".$request->q."%")
    					->with(['get_category', 'get_currency', 'get_images'])
    					->orderBy('created_at', 'DESC');
    	if ($request->has('category') && is_numeric($request->category)) {
    		$query->where('category_id', '=', $request->category);
    	}
    	$data = $query->paginate(env('PAGINATE_NUMBER'));
    	return view("FrontendViews.search", compact('categories', 'data', 'request'));
    }





}
