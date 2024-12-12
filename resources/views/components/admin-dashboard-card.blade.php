<!-- resources/views/components/admin-dashboard-card.blade.php -->
@props([
    'class' => 'w-full md:w-1/3 max-w-md',
    'title' => null,
    'subtitle' => null,
    'val1' => 0,
    'val2' => 0,
    'stateName' => null,
    'footershow' => false,
    'heading1' => null,
    'heading2'=>null,
])

<div {{ $attributes->merge(['class' => $class . ' bg-white shadow-lg rounded-lg p-6']) }}>
    <!-- Card Header -->
    <div class="mb-6">
        @if($title)
            <h2 class="text-xl font-semibold text-gray-900">{{ $title }}</h2>
        @endif

        @if($subtitle)
            <p class="text-sm text-gray-500">{{ $subtitle }}</p>
        @endif


    </div>

    <!-- Card Body -->
    <div class="space-y-4">
        @if($heading1)
            <div class="flex justify-between">
                <span class="text-sm font-medium text-gray-700">{{ $heading1 }}</span>
                <span class="text-xl font-semibold text-gray-900">{{ $val1 }}</span>
            </div>
        @endif

        @if($heading2)
            <div class="flex justify-between">
                <span class="text-sm font-medium text-gray-700">{{ $heading2 }}</span>
                <span class="text-xl font-semibold text-gray-900">{{ $val2 }}</span>
            </div>
        @endif
    </div>
    <!-- Conditionally Render Footer -->
    @if($footershow)
        <div class="mt-6 flex items-center justify-between">
            <x-button label="Refresh"/>
        </div>
    @endif
</div>
