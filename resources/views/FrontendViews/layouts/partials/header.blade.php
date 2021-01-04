<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>Classified Ads</title>
        @stack('styles')
    </head>
    <body style="background: #F1F3F6">
        <div id="app">
            <header class="bg-white">
                <div class="grid grid-cols-1 px-20">
                    <nav class="border-b border-gray-200 sm:items-baseline">
                        <ul class="flex justify-center items-center sm:items-baseline">
                            <li><a class="block p-4 hover:bg-gray-100" href="{{url('/')}}">Home</a></li>
                            @foreach($categories as $category)
                            <li><a class="block p-4 hover:bg-gray-100" href="{{ route('browseByCategory.get', $category->category_name) }}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </header>

            <main>
