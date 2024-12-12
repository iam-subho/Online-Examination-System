@if(session()->has('successMessage'))
    <div
        x-data="{
        show: true,
        progress: 100,
        timer: null,
        startTimer() {
            const startTime = Date.now();
            const duration = 5000; // 5 seconds

            this.timer = setInterval(() => {
                const elapsed = Date.now() - startTime;
                this.progress = Math.max(0, 100 - (elapsed / duration * 100));

                if (this.progress <= 0) {
                    this.show = false;
                    clearInterval(this.timer);
                }
            }, 16) // ~60 fps for smooth animation
        }
    }"
        x-init="startTimer()"
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 shadow-lg w-80 z-50 bg-green-500"
    >
        <div class="px-6 py-4 relative">
            <!-- Close Button -->
            <button
                @click="show = false; clearInterval(timer)"
                class="absolute top-2 right-2 text-white hover:text-gray-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Message Content -->
            <p class="text-white">{{ session('successMessage') }}</p>
        </div>

        <!-- Progress Bar -->
        <div class="h-1 bg-white bg-opacity-50">
            <div
                x-bind:style="`width: ${progress}%`"
                class="h-full bg-white transition-all duration-[16ms] ease-linear"
            ></div>
        </div>
    </div>
@endif

@if(session()->has('errorMessage'))
    <div
        x-data="{
        show: true,
        progress: 100,
        timer: null,
        startTimer() {
            const startTime = Date.now();
            const duration = 5000; // 5 seconds

            this.timer = setInterval(() => {
                const elapsed = Date.now() - startTime;
                this.progress = Math.max(0, 100 - (elapsed / duration * 100));

                if (this.progress <= 0) {
                    this.show = false;
                    clearInterval(this.timer);
                }
            }, 16) // ~60 fps for smooth animation
        }
    }"
        x-init="startTimer()"
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 shadow-lg w-80 z-50 bg-red-500"
    >
        <div class="px-6 py-4 relative">
            <!-- Close Button -->
            <button
                @click="show = false; clearInterval(timer)"
                class="absolute top-2 right-2 text-white hover:text-gray-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Message Content -->
            <p class="text-white">{{ session('errorMessage') }}</p>
        </div>

        <!-- Progress Bar -->
        <div class="h-1 bg-white bg-opacity-50">
            <div
                x-bind:style="`width: ${progress}%`"
                class="h-full bg-white transition-all duration-[16ms] ease-linear"
            ></div>
        </div>
    </div>
@endif
