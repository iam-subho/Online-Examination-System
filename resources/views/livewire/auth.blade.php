<div class="flex h-screen">
    <div class="w-1/2 bg-blue-500 flex items-center justify-center">
        <div class="text-white text-4xl font-bold">Welcome To Abhyasana</div>
        @if(session('error'))
            <x-alert title="{{ session('error') }}" red/>
        @endif
    </div>
    <div class="w-1/2 flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <x-input icon="envelope" label="Email" wire:model="email"
                             class="shadow appearance-none border rounded w-full text-gray-700 focus:outline-none focus:shadow-outline"
                             placeholder="Enter your email address" required/>
                </div>
                <div class="mb-4">
                    <x-password icon="finger-print" label="Password" wire:model="password"
                                class="shadow appearance-none border rounded w-full text-gray-700 focus:outline-none focus:shadow-outline"
                                placeholder="Enter your password" required/>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" wire:loading.attr="disabled"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                    <div wire:loading>
                        <x-tc-spinner/>
                    </div>
                    <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Forgot Password?
                    </a>
                </div>
                {{--                <div class="mt-4 text-center">--}}
                {{--                    <a href="#" class="text-blue-500 hover:text-blue-800">Don't have an account? Sign Up</a>--}}
                {{--                </div>--}}
            </form>
        </div>
    </div>
</div>
