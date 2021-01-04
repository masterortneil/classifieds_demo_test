<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ad;
use App\Models\Image;
use Carbon\Carbon;


class AdsController extends Controller
{
    public function store_ad(Request $request){
        $validation = Validator::make($request->all(), [
            'title'=>'required|string|max:80',
            'price'=>'required|numeric|min:1',
            'currency'=>'required|numeric|in:1,2',
            'category'=>'required|numeric',
            'contact_number'=>'required|string|max:16',
            'email'=>'required|email|max:99',
            'images'=>'required|array|min:1',
            'description'=>'required|string|min:50|max:10000'
        ]);

        if ($validation->fails()) {
            return response()->json(['errors'=>$validation->messages()->get('*')], 422);
        }

        $current_time = Carbon::now();

        $slug = $this->createSlug($request->title);

        $new_ad = new Ad();
        $new_ad->title = $request->title;
        $new_ad->slugurl = $slug;
        $new_ad->price = $request->price;
        $new_ad->contactnumber = $request->contact_number;
        $new_ad->email = $request->email;
        $new_ad->description = $request->description;
        $new_ad->category_id = $request->category;
        $new_ad->currency_id  = $request->currency;
        $new_ad->created_at = $current_time;
        $new_ad->save();

        //save image
        foreach ($request->images as $key => $image) {
            Image::insert([
                'img_name'=>$image,
                'ad_id'=>$new_ad->id,
                'created_at'=>$current_time,
            ]);
        }

        return response()->json(['message'=>'Ad Created Successfully'], 200);
    }


    //Create Slug
    private function createSlug($title, $id = 0){
        // Normalize the title
        $slug = \Str::slug($title, '-');
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 500; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    private function getRelatedSlugs($slug, $id = 0)
    {
        return Ad::select('slugurl')->where('slugurl', 'like', $slug.'%')
            ->where('ad_id', '<>', $id)
            ->get();
    }
}
