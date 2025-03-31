<x-layouts.app
    :title="$store->meta_title"
    :description="$store->meta_description"
    :image="optional($store->image) ? asset('storage/' . $store->image) : null"
>
    <div class="max-w-4xl mx-auto py-16 px-6 text-center space-y-10">
        <div>
            <x-flux::heading size="5xl" weight="bold" class="text-gray-900">
                {{ $store->name }}
            </x-flux::heading>
            <x-flux::text size="lg" class="text-gray-600 mt-2">
                {{ $store->address }}, {{ $store->city }},
                {{ $store->postcode }}
            </x-flux::text>
        </div>

        <div class="space-y-2">
            <x-flux::text size="md" class="text-gray-500">
                📞 {{ $store->phone }}
            </x-flux::text>
            <x-flux::text size="md" class="text-gray-500">
                📧 {{ $store->email }}
            </x-flux::text>
        </div>

        @if($store->google_maps_link)
        <div>
            <x-flux::button
                variant="primary"
                as="a"
                :href="$store->google_maps_link"
                target="_blank"
                class="px-6 py-3 text-base"
            >
                View on Google Maps
            </x-flux::button>
        </div>
        @endif @if($store->image)
        <div class="mt-10">
            <img
                src="{{ asset('storage/' . $store->image) }}"
                alt="{{ $store->name }}"
                class="w-full max-h-[500px] rounded-2xl object-cover shadow-xl border border-gray-200"
            />
        </div>
        @endif
    </div>
</x-layouts.app>
