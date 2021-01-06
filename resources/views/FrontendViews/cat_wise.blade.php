@extends("Frontendviews.layouts.master")
@section("content")

    <section id="page_content">


        <div class="px-20 mt-5 wrapper">
            <h2 class="text-3xl mb-3 text-gray-500">{{$data->total()}} ads found in <b>{{$catData->category_name}}</b></h2>
                @foreach($data as $key=>$row)
                    <div class="flex justify-between relative p-2 border-solid border-2 border-green-500 mb-4 single_item">
                        <div class="w-1/3 featured_image">
                            <a href="{{route('details.get', $row->slugurl)}}">
                                <img src="{{$row->get_images[0]->img_name}}" class="w-full">
                            </a>
                        </div>
                        <div class="w-4/6 px-5 py-2 content_box mb-6">
                            <h3 class="text-2xl mb-3 font-bold text-gray-400"><a href="{{route('details.get', $row->slugurl)}}">{{$row->title}}</a></h3>
                            <h4 class="text-xl">{{$row->get_currency->currency_name}} {{$row->price}}</h4>
                            <div class="mt-3">
                                <p>
                                    {{\Str::words($row->description, env('WORDS_LIMIT'))}}
                                </p>
                            </div>
                        </div>

                        <div class="absolute bottom-0 right-0">
                            <div class="flex justify-between">
                                <a href="" class="w-12 p-2"><img src="/images/icons/whatsapp.png" class="w-12"></a>
                                <a href="" class="w-12 p-2"><img src="/images/icons/phone-call.png" class="w-12"></a>
                                <a href="" class="w-12 p-2"><img src="/images/icons/envelope.png" class="w-12"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4 mb-10">
                    {!! $data->render() !!}
                </div>
        </div>
    </section>
@endsection
