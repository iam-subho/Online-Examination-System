<div
    x-data="{
        show: @entangle('show'), // Bind show property to Alpine.js
        type: @entangle('type'), // Bind type property to Alpine.js
        message: @entangle('message'), // Bind message property to Alpine.js
        //startTime: @entangle('startTime'), // Bind message property to Alpine.js
        duration: @entangle('duration'), // Bind message property to Alpine.js
        progress: 100,
        timer: null,
        startTimer(sstartTime) {

            const startTime = sstartTime;

            const duration = 2000;

            this.timer = setInterval(() => {
                const elapsed = Date.now() - startTime;
                this.progress = Math.max(0, 100 - (elapsed / duration * 100));

                if (this.progress <= 0) {
                    this.show = false; // Hide the alert after progress is done
                    clearInterval(this.timer);
                }
            }, 16); // ~60 fps for smooth animation
        },
        listenToAlertEvent() {
            window.addEventListener('alert-show', () => {
                this.startTimer(Date.now());
            });
        }
    }"
    x-init="listenToAlertEvent()"
    x-show="show"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-4 shadow-lg w-80 z-50"
    :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    x-cloak
>
    <div class="px-6 py-4 relative">
        <!-- Close Button -->
        <button
            @click="show = false; clearInterval(timer)"
            class="absolute top-2 right-2 text-white hover:text-gray-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Message Content -->
        <p class="text-white">{{ $message }}</p>
    </div>

    <!-- Progress Bar -->
    <div class="h-1 bg-white bg-opacity-50">
        <div
            x-bind:style="`width: ${progress}%`"
            class="h-full bg-white transition-all duration-[16ms] ease-linear"
        ></div>
    </div>
</div>
