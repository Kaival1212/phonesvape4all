@props([ 'title' => 'Phones & Vapes 4 All', 'description' => 'Visit Phones &
Vapes 4 All for mobile repairs, accessories, and vape supplies across our UK
locations.', 'image' => null, ])

<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title }}</title>
        <meta name="description" content="{{ $description }}" />
        <meta
            name="keywords"
            content="phones, vapes, mobile repair, accessories, UK vape shop, phones and vapes 4 all"
        />
        <meta name="author" content="KNconsulting" />

        <meta property="og:title" content="{{ $title }}" />
        <meta property="og:description" content="{{ $description }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />
        @if($image)
        <meta property="og:image" content="{{ $image }}" />
        @endif @vite('resources/css/app.css') @livewireStyles
    </head>
    <body class="bg-white text-gray-800 antialiased">
        <flux:header>
            {{ $slot }}
        </flux:header>
        @livewireScripts
    </body>
</html>
