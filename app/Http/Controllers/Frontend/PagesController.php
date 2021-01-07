<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;
use Artisan;
use Closure;

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

    public function ad_form(){
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view("FrontendViews.add-ads", compact('categories'));
    }

    public function browse_category_wise($catName){
        $catData = Category::where('category_name', $catName)->first();
        if (!$catData) {
            return abort(404);
        }

        //else
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $data = Ad::where('category_id', '=', $catData->category_id)
            ->with(['get_category', 'get_images', 'get_currency'])
            ->orderBy('created_at', 'DESC')->paginate(env('PAGINATE_NUMBER'));
        return view("FrontendViews.cat_wise", compact('categories', 'data', 'catData'));
    }

    public function details($slug){
        $data = Ad::where('slugurl', $slug)->first();
        if (!$data) {
            return abort(404);
        }
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view("FrontendViews.details", compact('data', 'categories'));
    }

    public function handle($request, Closure $next)
    {
        if (env('APP_DEBUG') || env('APP_ENV') === 'local')
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        return $next($request);
    }
}
