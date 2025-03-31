<!-- Subheader -->

@props(['store'])

<header
    class="bg-white dark:bg-gray-800 py-4 px-6 border-b border-gray-200 dark:border-gray-700"
>
    <div
        class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4"
    >
        <!-- Left: Store Name & Links -->
        <div
            class="flex flex-col md:flex-row items-center gap-6 text-center md:text-left"
        >
            <h1
                class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white"
            >
                {{ $store->name }}
            </h1>

            <nav
                class="flex gap-4 text-sm md:text-base text-gray-600 dark:text-gray-300"
            >
                <a href="#how-it-works" class="hover:text-blue-600 transition"
                    >How it works?</a
                >
                <a href="#support" class="hover:text-blue-600 transition"
                    >Support</a
                >
            </nav>
        </div>

        <!-- Right: Socials / Contact -->
        <nav
            class="flex gap-4 text-sm md:text-base text-gray-600 dark:text-gray-300"
        >
            <a
                href="https://www.facebook.com/hrdeep.phonetics"
                target="_blank"
                rel="noopener noreferrer"
                class="hover:text-blue-600 transition"
                >Facebook</a
            >
            <a
                href="https://twitter.com/vapes4all"
                target="_blank"
                rel="noopener noreferrer"
                class="hover:text-blue-600 transition"
                >Twitter</a
            >
            <a
                href="https://www.instagram.com/phonesvapes4all/"
                target="_blank"
                rel="noopener noreferrer"
                class="hover:text-blue-600 transition"
                >Instagram</a
            >
            <a
                href="tel:{{ $store->phone }}"
                class="hover:text-blue-600 transition"
                >📞 {{ $store->phone }}</a
            >
            <a
                href="mailto:{{ $store->email }}"
                class="hover:text-blue-600 transition"
                >✉️ Email</a
            >
        </nav>
    </div>
</header>
