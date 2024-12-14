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

            <form class="space-y-4" wire:submit.prevent="store" id="examForm">
                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-select
                            label="Exam Category"
                            class="border"
                            wire:model="exam_category_id"
                            :options="$exam_categories"
                            placeholder="Select Category"
                        />
                    </div>
                    <div class="flex-1">
                        <x-select
                            label="Exam Status"
                            class="border"
                            wire:model="status"
                            :options="$status_options"
                            placeholder="Select Status"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="text"
                            label="Exam UID"
                            class="border"
                            wire:model="exam_uid"
                            readonly
                        />
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-tc-input
                            type="number"
                            label="Total Question"
                            class="border"
                            wire:model="total_question"
                            placeholder="Number of Questions"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="datetime-local"
                            label="Exam Date"
                            class="border"
                            wire:model="exam_date"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="datetime-local"
                            label="Exam Expire"
                            class="border"
                            wire:model="exam_expire_date"
                        />
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-tc-input
                            type="number"
                            label="Exam Duration (min)"
                            class="border"
                            wire:model="duration"
                            placeholder="Exam Duration,0 means no limit"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="number"
                            label="Time per ques (sec)"
                            class="border flex-1"
                            wire:model="time_limit_per_question"
                            placeholder="Time per Question,0 means no limit"
                            min="10"
                            max="60"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="number"
                            label="Passing Percentage"
                            class="border"
                            wire:model="passing_percentage"
                            placeholder="Passing %"
                            min="0"
                            max="100"
                        />
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <x-tc-input
                            type="text"
                            label="Exam Title"
                            class="border"
                            wire:model="title"
                            placeholder="Enter Exam Title"
                        />
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Exam Description
                    </label>
                    <x-marry-editor
                        wire:model="description"
                        folder="exams"
                        hint="Provide detailed exam description"
                    />
                </div>


                <div class="flex items-center space-x-4 mb-4">

                    <div class="flex items-center">
                        <x-toggle
                            wire:model="result_published"
                            label="Results published"
                        />
                    </div>
                </div>

                <div class="flex justify-end">
                    <x-button
                        type="submit"
                        label="{{ $this->id ? 'Update Exam' : 'Create Exam' }}"
                        primary
                    />
                </div>
            </form>
        </x-card-content>
    </x-card>
</div>
