<div class="fixed top-0 left-0 right-0 bg-white text-black border-b-2 h-16 px-6 flex items-center justify-between z-10">
    <!-- User Greeting (Visible on medium and larger screens) -->
    <div class="text-lg font-semibold hidden md:block">
        Welcome, {{ Auth::user()->name }}
    </div>

    @php
        $imgid = Auth::user()->id % 70;
        $imgUrl = "https://i.pravatar.cc/150?img=" . $imgid;
    @endphp

        <!-- Dropdown for smaller screens (visible from `sm` breakpoint) -->
    <div class=" md:hidden">
        <x-dropdown bottom-start>
            @slot('trigger')
                <x-icon name="bars-3" />
            @endslot
            <x-menu-items></x-menu-items>
        </x-dropdown>
    </div>

    <!-- Avatar Dropdown (Always visible on all screen sizes) -->
    <div class="text-sm">
        <x-dropdown>
            @slot('trigger')
                <x-avatar :image="$imgUrl" class="cursor-pointer" ring ring-color="sky" badge badge-color="sky" />
            @endslot

            <x-dropdown-item label="Profile" icon="user" />
            <x-dropdown-item label="Update password" icon="key" />
            <x-separator />
            <x-dropdown-item label="Sign out" icon="arrow-right-end-on-rectangle" link="{{ route('admin.logout') }}" />
        </x-dropdown>
    </div>
</div>
