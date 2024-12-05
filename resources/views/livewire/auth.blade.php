<div class="flex h-screen">
    <div class="w-1/2 bg-blue-500 flex items-center justify-center">
        <div class="text-white text-4xl font-bold">Welcome To</div>
        <div class="text-white text-4xl font-bold">Abhyasana</div>
    </div>
    <div class="w-1/2 flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input wire:model.lazy="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your email address">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input wire:model.lazy="password" type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your password">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                    <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Forgot Password?
                    </a>
                </div>
                <div class="mt-4 text-center">
                    <a href="#" class="text-blue-500 hover:text-blue-800">Don't have an account? Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>
