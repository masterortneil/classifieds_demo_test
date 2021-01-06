@extends("Frontendviews.layouts.master")
@section("content")

    <section id="page_content">


        <div class="px-20 mt-5 wrapper">
            <h2 class="text-3xl mb-3 text-gray-500">{{$data->total()}} ads found in <b>{{$catData->category_name}}</b></h2>

        </div>
    </section>
@endsection
