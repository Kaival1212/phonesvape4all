@props(['store'])

<footer
    class="bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 border-t border-gray-200 dark:border-gray-700 mt-12"
>
    <div
        class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-10"
    >
        <!-- Store Info -->
        <div>
            <h2 class="text-xl font-bold mb-4">{{ $store->name }}</h2>
            <p class="text-sm">
                {{ $store->address }}, {{ $store->city }},
                {{ $store->postcode }}
            </p>
            <p class="text-sm mt-2">
                📞
                <a
                    href="tel:{{ $store->phone }}"
                    class="hover:underline"
                    >{{ $store->phone }}</a
                >
            </p>
            <p class="text-sm">
                📧
                <a
                    href="mailto:{{ $store->email }}"
                    class="hover:underline"
                    >{{ $store->email }}</a
                >
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-md font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="#" class="hover:text-blue-600">Phone Repairs</a>
                </li>
                <li><a href="#" class="hover:text-blue-600">Vapes</a></li>
                <li><a href="#" class="hover:text-blue-600">Accessories</a></li>
                <li>
                    <a href="#" class="hover:text-blue-600">Book Appointment</a>
                </li>
                <li><a href="#" class="hover:text-blue-600">Contact Us</a></li>
            </ul>
        </div>

        <!-- Socials -->
        <div>
            <h3 class="text-md font-semibold mb-4">Connect with Us</h3>
            <div class="flex gap-4 text-gray-600 dark:text-gray-300">
                <a
                    href="https://www.facebook.com/hrdeep.phonetics"
                    target="_blank"
                    aria-label="Facebook"
                    class="hover:text-blue-600 transition"
                >
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a
                    href="https://www.instagram.com/phonesvapes4all"
                    target="_blank"
                    aria-label="Instagram"
                    class="hover:text-pink-500 transition"
                >
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <a
                    href="https://twitter.com/vapes4all"
                    target="_blank"
                    aria-label="Twitter"
                    class="hover:text-blue-400 transition"
                >
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </div>
        </div>

        <div>
            <h3 class="text-md font-semibold mb-4">Connect with Us</h3>
            <div class="flex gap-4 text-gray-600 dark:text-gray-300">
                <a
                    href="https://www.facebook.com/hrdeep.phonetics"
                    target="_blank"
                    aria-label="Facebook"
                    class="hover:text-blue-600 transition"
                >
                    <i class="fab fa-facebook-f"></i> Facebook
                </a>
                <a
                    href="https://www.instagram.com/phonesvapes4all"
                    target="_blank"
                    aria-label="Instagram"
                    class="hover:text-pink-500 transition"
                >
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <a
                    href="https://twitter.com/vapes4all"
                    target="_blank"
                    aria-label="Twitter"
                    class="hover:text-blue-400 transition"
                >
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </div>
        </div>
    </div>



    <div
        class="text-center text-sm text-gray-500 dark:text-gray-400 mt-6 py-4 border-t border-gray-200 dark:border-gray-700"
    >
        &copy; {{ now()->year }} {{ $store->name }}. All rights reserved.
    </div>
</footer>
