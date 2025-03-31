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

    <!-- Swiper Styles -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <!-- Swiper Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new Swiper(".mySwiper", {
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>

    <body class="bg-white text-gray-800 antialiased">
        {{ $slot }}

        @livewireScripts
    </body>
</html>
