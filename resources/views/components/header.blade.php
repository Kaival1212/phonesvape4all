@props(['store'])

<div class="flex flex-row w-full justify-between items-center text-center">
    <img
        src="{{ asset('storage/logonew.jpeg') }}"
        alt="{{ $store->name }}"
        class="object-fit w-40 h-30 border-r mx-2 py-2"
    />

    <div class="gird grid-cols-2 grid-rows-1">
        <flux:dropdown>
            <flux:button
                variant="ghost"
                class="px-6 py-2 text-base font-semibold"
            >
                Phone Repair
            </flux:button>

            <flux:menu>
                <flux:menu.item class="flex flex-col">
                    @foreach([ 'Apple', 'Samsung', 'Google', 'OnePlus',
                    'Huawei', 'Honor', 'Black Berry', 'Xiaomi', 'Motorola',
                    'Nokia', 'HTC', 'All' ] as $brand)
                    <flux:button href="#" variant="ghost">
                        {{ $brand }}
                    </flux:button>
                    @endforeach
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button
                variant="ghost"
                class="px-6 py-2 text-base font-semibold"
            >
                Table Repair
            </flux:button>

            <flux:menu>
                <flux:menu.item class="flex flex-col">
                    <flux:button href="#" variant="ghost">
                        Apple Ipad
                    </flux:button>

                    <flux:button href="#" variant="ghost">
                        Samsung Galaxy Tab
                    </flux:button>

                    <flux:button href="#" variant="ghost">
                        Microsoft Surface
                    </flux:button>

                    <flux:button href="#" variant="ghost"> All </flux:button>
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button
                variant="ghost"
                class="px-6 py-2 text-base font-semibold"
            >
                Computer Repair
            </flux:button>

            <flux:menu>
                <flux:menu.item class="flex flex-col">
                    <flux:button href="#" variant="ghost">
                        Apple Macbook and IMac
                    </flux:button>

                    <flux:button href="#" variant="ghost"> Dell </flux:button>
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button
                variant="ghost"
                class="px-6 py-2 text-base font-semibold"
            >
                Other Repair
            </flux:button>

            <flux:menu>
                <flux:menu.item class="flex flex-col">
                    <flux:button href="#" variant="ghost">
                        Drone Repair
                    </flux:button>

                    <flux:button href="#" variant="ghost">
                        Nintendo
                    </flux:button>
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>

        <flux:button variant="ghost" class="px-6 py-2 text-base font-semibold">
            Data Recovery
        </flux:button>

        <flux:button variant="ghost" class="px-6 py-2 text-base font-semibold">
            Contact
        </flux:button>

        <flux:button variant="ghost" class="px-6 py-2 text-base font-semibold">
            Book Appointment
        </flux:button>
    </div>
</div>
