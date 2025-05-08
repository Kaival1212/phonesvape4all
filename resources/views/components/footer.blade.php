@props(['store'])

<footer class="bg-gray-900 text-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Store Info -->
            <div>
                <h2 class="text-xl font-bold mb-6 text-white">
                    {{ $store->name }}
                </h2>
                <p class="text-sm text-gray-300 mb-4">
                    {{ $store->address }}, {{ $store->city }},
                    {{ $store->postcode }}
                </p>
                <div class="space-y-3">
                    <p class="text-sm text-gray-300">
                        <i class="fas fa-phone-alt mr-2"></i>
                        <a
                            href="tel:{{ $store->phone }}"
                            class="hover:text-blue-400 transition"
                            >{{ $store->phone }}</a
                        >
                    </p>
                    <p class="text-sm text-gray-300">
                        <i class="fas fa-envelope mr-2"></i>
                        <a
                            href="mailto:{{ $store->email }}"
                            class="hover:text-blue-400 transition"
                            >{{ $store->email }}</a
                        >
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-md font-semibold mb-6 text-white">
                    Quick Links
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a
                            href="{{ route('repair') }}"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Phone Repairs</a
                        >
                    </li>
                    <li>
                        <a
                            href="{{ route('buy') }}"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Buy Devices</a
                        >
                    </li>
                    <li>
                        <a
                            href="/sell"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Sell Your Device</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Book Appointment</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Contact Us</a
                        >
                    </li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-md font-semibold mb-6 text-white">
                    Our Services
                </h3>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Screen Repairs</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Battery Replacement</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Water Damage</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Data Recovery</a
                        >
                    </li>
                    <li>
                        <a
                            href="#"
                            class="text-gray-300 hover:text-blue-400 transition"
                            >Device Unlocking</a
                        >
                    </li>
                </ul>
            </div>

            <!-- Social & Newsletter -->
            <div>
                <h3 class="text-md font-semibold mb-6 text-white">
                    Connect With Us
                </h3>
                <div class="flex gap-4 mb-6">
                    <a
                        href="https://www.facebook.com/hrdeep.phonetics"
                        target="_blank"
                        aria-label="Facebook"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            />
                        </svg>
                    </a>
                    <a
                        href="https://www.instagram.com/phonesvapes4all"
                        target="_blank"
                        aria-label="Instagram"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5zm4.25 2.25a6.25 6.25 0 1 1-6.25 6.25 6.25 6.25 0 0 1 6.25-6.25zm0 1.5a4.75 4.75 0 1 0 4.75 4.75A4.75 4.75 0 0 0 12 5.25zm5.25 1.25a1 1 0 1 1-1 1 1 1 0 0 1 1-1z"
                            />
                        </svg>
                    </a>
                    <a
                        href="https://twitter.com/vapes4all"
                        target="_blank"
                        aria-label="Twitter"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                d="M22.46 5.94c-.8.36-1.67.6-2.58.71a4.48 4.48 0 0 0 1.97-2.48 8.94 8.94 0 0 1-2.83 1.08 4.48 4.48 0 0 0-7.63 4.08A12.72 12.72 0 0 1 3.11 4.6a4.48 4.48 0 0 0 1.39 5.98c-.7-.02-1.36-.21-1.94-.53v.05a4.48 4.48 0 0 0 3.6 4.39c-.33.09-.68.14-1.04.14-.25 0-.5-.02-.74-.07a4.48 4.48 0 0 0 4.18 3.11A9 9 0 0 1 2 19.54a12.72 12.72 0 0 0 6.88 2.02c8.26 0 12.78-6.84 12.78-12.78 0-.2 0-.39-.01-.58A9.22 9.22 0 0 0 24 4.59a8.93 8.93 0 0 1-2.54.7z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-gray-800">
            <div
                class="flex flex-col md:flex-row justify-between items-center gap-4"
            >
                <p class="text-sm text-gray-400">
                    &copy; {{ now()->year }} {{ $store->name }}. All rights
                    reserved.
                </p>
                <div class="flex gap-6 text-sm">
                    <a
                        href="#"
                        class="text-gray-400 hover:text-blue-400 transition"
                        >Privacy Policy</a
                    >
                    <a
                        href="#"
                        class="text-gray-400 hover:text-blue-400 transition"
                        >Terms of Service</a
                    >
                    <a
                        href="#"
                        class="text-gray-400 hover:text-blue-400 transition"
                        >Cookie Policy</a
                    >
                </div>
            </div>
        </div>
    </div>
</footer>
