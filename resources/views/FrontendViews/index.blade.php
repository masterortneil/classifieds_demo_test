@extends("Frontendviews.layouts.master")
@section("content")

            <section class="bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500">
                <div class="p-20">
                    <form id="search--form" class="py-20" onsubmit="searchForm(event)">
                        <div class="flex justify-center items-center sm:items-baseline box">
                            <div class="mr-2">
                                <input id="searchKeyInput" type="text" name="" placeholder="Search Advert Title" class="bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                            </div>
                            <div class="mr-2">
                                <select id="searchInCategoryInput" class="bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2">
                                <button type="submit" class="btn border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section>
                
                <div class="p-20 mt-5">
                    <h2 class="text-3xl mb-3 font-bold text-gray-500">Browse by category</h2>
                    <div class="grid sm:grid-cols-1 md:grid-cols-4 gap-4">
                        @foreach($categories as $category)
                        <div class="p-3 bg-gray-200 hover:bg-gray-300">
                            <a href="{{ route('browseByCategory.get', $category->category_name) }}">
                                <div class="flex justify-center">
                                    <img src="/images/cat_pic.png" class="object-center">
                                </div>
                                <div class="flex justify-center">
                                    <h4 class="font-bold text-gray-500">{{$category->category_name}}</h4>
                                </div>
                                <div class="flex justify-center">
                                    <h4 class="font-bold text-gray-500">
                                        <?php
                                            $totalAdsCount = \App\Models\Ad::where('category_id', $category->category_id)->count();
                                        ?>
                                        {{$totalAdsCount}}
                                    </h4>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                </div>
            </section>
@endsection