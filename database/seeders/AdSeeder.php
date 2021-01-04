<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Ad;
use Faker\Factory as Faker;
class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Schema::disableForeignKeyConstraints();
    	Ad::truncate();
    	Schema::enableForeignKeyConstraints();
    	$faker = Faker::create();
        for ($i=0; $i < env('SEEDER_ITEM_LIMT'); $i++) { 
        	$title = "My Test Advert - ".$i;
        	$title = $title."-".$i;
        	$slug = \Str::slug($title, '-');
	    	Ad::insert([
	            'title' => $title,
	            'slugurl' => $slug,
	            'price' => mt_rand(10, 500),
	            'contactnumber' => mt_rand(12, 12),
	            'email' => \Str::random(10, 20).$i.'@mail.com',
	            'description' => "Grab this Christmas special before prices go up!",
	            'category_id' => mt_rand(1,4),
	            'currency_id' => mt_rand(1,2),
	            'created_at' => \Carbon\Carbon::now(),
	        ]);
    	}
    }
}
