<div>
    <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
        <x-card-content>
            <div class="mb-4">
                <x-icon name="arrow-uturn-left" onclick="window.history.back()" class="cursor-pointer hover:text-red-600"></x-icon>
            </div>
            <form class="space-y-4" wire:submit.prevent="store" id="questionForm">
                <!-- Row with two selects and input on the same line -->
                <div class="flex flex-col sm:flex-row md:flex-row gap-4">
                    <div class="flex-1">
                        <x-select
                            label="Question Type"
                            class="border"
                            wire:model.live="type"
                            :options="$question_type"
                            placeholder="Select Type"
                        />
                    </div>
                    <div class="flex-1">
                        <x-select
                            label="Difficulty Level"
                            class="border"
                            wire:model="difficulty"
                            :options="$difficulty_level"
                            placeholder="Select Level"
                        />
                    </div>
                    <div class="flex-1">
                        <x-tc-input
                            type="number"
                            label="Points"
                            class="border"
                            wire:model="points"
                            placeholder="Enter Points"
                        />
                    </div>
                </div>

                <!-- Description field with LaTeX support -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <x-marry-editor wire:model="question_content" folder="questions" hint="The full product description" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Answer Options</label>
                    <div id="answers" class="space-y-4">
                        @if($type == 'mcq')
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_1" class="flex-1 w-full"/>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="1"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-1" />
                                    <label for="correct-answer-1" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_2" class="flex-1 w-full"/>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="2"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-2" />
                                    <label for="correct-answer-2" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_3" class="flex-1 w-full"/>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="3"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-3" />
                                    <label for="correct-answer-3" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_4" class="flex-1 w-full"/>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="4"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-4" />
                                    <label for="correct-answer-4" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                        @elseif($type == 'true_false')
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_1" class="flex-1 w-full"/>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="1"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-1" />
                                    <label for="correct-answer-1" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <x-marry-textarea wire:model="option_2" class="flex-1 w-full">True</x-marry-textarea>
                                <div class="flex items-center">
                                    <input
                                        type="radio"
                                        wire:model="correct_answer"
                                        value="2"
                                        class="form-radio h-5 w-5 text-green-600"
                                        id="correct-answer-2" />
                                    <label for="correct-answer-2" class="ml-2 text-sm text-gray-700">Correct Answer</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <x-button type="submit" label="Submit" />
            </form>
        </x-card-content>
    </x-card>
</div>
