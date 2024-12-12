<div class="fixed top-0 left-0 right-0 bg-white text-black border-b-2 h-16 px-6 flex items-center justify-between z-10">
    <div class="text-lg font-semibold">Welcome, {{ Auth::user()->name }}</div>
    <div class="text-sm">
        @php
            $imgid = Auth::user()->id%70;
            $imgUrl =  "https://i.pravatar.cc/150?img=".$imgid
        @endphp
        <x-dropdown>
            @slot('trigger')
                <x-avatar :image="$imgUrl" ring ring-color="sky" badge badge-color="sky" />
            @endslot

            <x-dropdown-item label="Profile" icon="user" />
            <x-dropdown-item label="Update password" icon="key" />

            <x-separator />

            <x-dropdown-item label="Sign out" icon="arrow-right-end-on-rectangle" />
        </x-dropdown>

    </div>
</div>
