<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome {{ Auth::user()->name }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">

    <!-- Alert Section with Alpine.js for smooth auto-dismiss -->
{{--    @if(session()->has('message'))--}}
{{--        <div--}}
{{--            x-data="{--}}
{{--            show: true,--}}
{{--            progress: 100,--}}
{{--            timer: null,--}}
{{--            startTimer() {--}}
{{--                const startTime = Date.now();--}}
{{--                const duration = 5000; // 10 seconds 1=1000--}}

{{--                this.timer = setInterval(() => {--}}
{{--                    const elapsed = Date.now() - startTime;--}}
{{--                    this.progress = Math.max(0, 100 - (elapsed / duration * 100));--}}

{{--                    if (this.progress <= 0) {--}}
{{--                        this.show = false;--}}
{{--                        clearInterval(this.timer);--}}
{{--                    }--}}
{{--                }, 16) // ~60 fps for smooth animation--}}
{{--            }--}}
{{--        }"--}}
{{--            x-init="startTimer()"--}}
{{--            x-show="show"--}}
{{--            x-transition:leave="transition ease-in duration-300"--}}
{{--            x-transition:leave-start="opacity-100 scale-100"--}}
{{--            x-transition:leave-end="opacity-0 scale-90"--}}
{{--            class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 shadow-lg w-80 z-50--}}
{{--                {{ session('message.type') == 'success' ? 'bg-green-500' : (session('message.type') == 'error' ? 'bg-red-500' : 'bg-blue-500') }}"--}}
{{--        >--}}
{{--            <div class="px-6 py-4 relative">--}}
{{--                <!-- Close Button -->--}}
{{--                <button--}}
{{--                    @click="show = false; clearInterval(timer)"--}}
{{--                    class="absolute top-2 right-2 text-white hover:text-gray-200"--}}
{{--                >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}

{{--                <!-- Message Content -->--}}
{{--                <p class="text-white font-bold">{{ session('message.title') }}</p>--}}
{{--                <p class="text-white">{{ session('message.content') }}</p>--}}
{{--            </div>--}}

{{--            <!-- Progress Bar -->--}}
{{--            <div class="h-1 bg-white bg-opacity-50">--}}
{{--                <div--}}
{{--                    x-bind:style="`width: ${progress}%`"--}}
{{--                    class="h-full bg-white transition-all duration-[16ms] ease-linear"--}}
{{--                ></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}

    @include('layouts.myalert')

    <!-- Content Layout -->
    <div class="flex">

        <!-- Include Sidebar -->
        <div class="w-64  py-14 text-white h-screen fixed top-0 left-0 hidden md:block">
            <x-menu-items></x-menu-items>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 md:ml-64 bg-gray-100">

            <!-- Include Topbar -->
            @include('layouts.topbar')

            <!-- Page Content -->
            <div class="pt-16 pb-8 px-6">
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</div>

@livewireScripts
@stack('scripts')
</body>
</html>
