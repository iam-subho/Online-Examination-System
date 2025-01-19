<div>
    <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
        <x-card-content>
            <div class="mb-4">
                <x-icon
                    name="arrow-uturn-left"
                    onclick="window.history.back()"
                    class="cursor-pointer hover:text-red-600"
                ></x-icon>
            </div>

            <form class="space-y-4" wire:submit.prevent="store" id="candidateForm">
                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-tc-input
                            type="text"
                            label="Full Name"
                            class="border"
                            wire:model="name"
                            placeholder="Enter Full Name"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="email"
                            label="Email Address"
                            class="border"
                            wire:model="email"
                            placeholder="Enter Email Address"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="text"
                            label="Phone Number"
                            class="border"
                            wire:model="phone"
                            placeholder="Enter Phone Number"
                        />
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-select
                            label="State"
                            class="border"
                            wire:model.live="state_id"
                            :options="$states"
                            placeholder="Select State"
                        />
                    </div>
                    <div class="flex-1">
                        <x-select
                            label="District"
                            class="border"
                            wire:model.live="district_id"
                            :options="$districts"
                            placeholder="Select District"
                        />
                    </div>
                    <div class="flex-1">
                        <x-select
                            label="School"
                            class="border"
                            wire:model="school_id"
                            :options="$schools"
                            placeholder="Select School"
                        />
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-select
                            label="Gender"
                            class="border"
                            wire:model="gender"
                            :options="$gender_options"
                            placeholder="Select Gender"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="date"
                            label="Date of Birth"
                            class="border"
                            wire:model="dob"
                        />
                    </div>
                    <div class="flex-1">
                        <x-select
                            label="Status"
                            class="border"
                            wire:model="status"
                            :options="$status_options"
                            placeholder="Select Status"
                        />
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button
                        type="submit"
                        label="Save Candidate"
                        primary
                    />
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
