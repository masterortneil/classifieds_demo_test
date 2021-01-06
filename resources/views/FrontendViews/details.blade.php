@extends("Frontendviews.layouts.master")

@section("content")

    <section id="page_content">

        <div class="px-20 mt-5 wrapper">
            <div class="mb-4 bg-white p-3">
                <h3 class="text-2xl mb-1 font-bold text-gray-400">{{$data->title}}</h3>
                <h5 class="text-xl text-green-400 font-bold">{{$data->get_currency->currency_name}} {{$data->price}}</h5>
            </div>

            <div class="flex justify-between relative p-2 mb-4 bg-white single_item">

                <div class="w-8/12 featured_image">

                        <div class="page-container">
                            @foreach($data->get_images as $key=>$image)
                                <div class="page active">
                                    <div class="page-content">
                                        <div class="head-shot p-2"><img src="{{$image->img_name}}"/></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                </div>

                <div class="w-4/12 px-5 py-2 mb-6 content_box">
                    <h4 class="text-xl font-bold p-2 border-solid border-b-2 border-light-blue-500  text-gray-400">Contact Seller</h4>
                    <div class="text-xl p-2 border-solid border-b-2 border-light-blue-500 italic  text-gray-400">
                        <a href="" class="block">
                            <div class="flex justify-start">
                                <div class="mr-2">
                                    <img src="/images/icons/whatsapp.png" class="w-8">
                                </div>
                                <div>
                                    <span class="">WhatsApp the seller</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="text-xl p-2 border-solid border-b-2 border-light-blue-500 italic  text-gray-400">
                        <a href="" class="block">
                            <div class="flex justify-start">
                                <div class="mr-2">
                                    <img src="/images/icons/phone-call.png" class="w-8">
                                </div>
                                <div>
                                    <span class="">{{substr($data->contactnumber, 0,  5)}}*** Show Numbers</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="text-xl p-2 border-solid border-b-2 border-light-blue-500 italic  text-gray-400">
                        <a href="" class="block">
                            <div class="flex justify-start">
                                <div class="mr-2">
                                    <img src="/images/icons/envelope.png" class="w-8">
                                </div>
                                <div>
                                    <span class=""><a href="mailto:{{$data->email}}?Subject=Advert: {{$data->title}}">Email the seller</a></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="flex justify-between relative p-2 mb-4 single_item">
                <div class="w-8/12 sm-width-100">
                    <div class="py-4 border-solid border-b-4 border-green-300">
                        <i class="fas fa-calendar-alt"></i> {{$data->created_at->diffForHumans()}}
                    </div>
                </div>
                <div class="w-4/12"></div>
            </div>

            <div class="mt-4">
                <h3 class="text-2xl mb-1 font-bold text-black-400">Description</h3>
                <div>
                    <p>
                        {!! nl2br($data->description) !!}
                    </p>
                </div>
            </div>
    </section>
@endsection

