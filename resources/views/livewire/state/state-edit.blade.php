<div>
    <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
        <x-card-content>
            <!-- Back Button -->
            <div class="mb-4">
                <x-icon name="arrow-uturn-left" wire:click="goBack" class="cursor-pointer hover:text-red-600" ></x-icon>

            </div>

            <form class="space-y-3" wire:submit.prevent="updateState">
                <x-input class="hidden" name="id" wire:model="id"/>
                <x-input label="Name" name="name" wire:model="name">
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </x-input>

                <x-button type="submit" label="Submit" />
            </form>
        </x-card-content>
    </x-card>
</div>
