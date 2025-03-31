<x-layouts.app
    :title="$store->meta_title"
    :description="$store->meta_description"
    :image="optional($store->image) ? asset('storage/' . $store->image) : null"
>
    <x-sub-header :store="$store" />
    <x-image-slider/>
    </div>

</x-layouts.app>
