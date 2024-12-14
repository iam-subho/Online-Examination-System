<div class="py-5 bg-gray-100">
    <!-- Wrapper Div to ensure a single root element -->
    <div>
        <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
            <x-card-header title="" class="text-right mb-2">
                @if(Auth::user()->can('Question.create'))
                    <x-button label="Add" icon="plus" green outline wire:click="gotoCreate" />
                @endif
            </x-card-header>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-center">
                    <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-4 text-sm font-medium">#</th>
                        <th class="py-3 px-4 text-sm font-medium">Type</th>
                        <th class="py-3 px-4 text-sm font-medium">Difficulty</th>
                        <th class="py-3 px-4 text-sm font-medium">Points</th>
                        <th class="py-3 px-4 text-sm font-medium">Question Text</th>
                        <th class="py-3 px-4 text-sm font-medium">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        @php
                          if(strpos($question->question_text, '<img') !== false){
                              $content = "<p>Question Contain Image</p>";
                          }else{
                              $content = $question->question_text;
                          }
                        @endphp
                        <tr class="border-t border-gray-200">
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question->id }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question->question_type }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question->difficulty }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question->points }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{!!  $content !!}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                @if(Auth::user()->can('Question.view'))
                                    <a href="#" wire:click="viewDetails({{ $question->id }})" class="text-yellow-500 hover:text-yellow-700" wire:loading.attr="disabled">View Details</a> |
                                @endif
                                @if(Auth::user()->can('Question.edit'))
                                    <a href="{{ route('admin.question-edit', $question->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                @endif
                                @if(Auth::user()->can('Question.delete'))
                                    | <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure!" wire:click="delete({{ $question->id }})">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $questions->links('pagination::tailwind') }}
                </div>
            </div>
        </x-card>




        <x-modal wire:model="myModal" 4xl>
            <div class="bg-white shadow-lg max-w-4xl mx-auto">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                    <h3 class="text-2xl font-bold text-black text-center">Question Details</h3>
                </div>

                @if($selectedQuestion)
                    <!-- Content Section -->
                    <div class="p-6">
                        <!-- Top row for Type, Difficulty, and Points -->
                        <div class="flex justify-between space-x-4 bg-gray-50 p-4 mb-6">
                            <div class="text-center flex-1">
                                <span class="block text-sm font-medium text-gray-600">Type</span>
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedQuestion->question_type }}</p>
                            </div>
                            <div class="text-center flex-1">
                                <span class="block text-sm font-medium text-gray-600">Difficulty</span>
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedQuestion->difficulty }}</p>
                            </div>
                            <div class="text-center flex-1">
                                <span class="block text-sm font-medium text-gray-600">Points</span>
                                <p class="text-lg font-semibold text-gray-900">{{ $selectedQuestion->points }}</p>
                            </div>
                        </div>

                        <!-- Question Description Box -->
                        <div class="bg-gray-50 border border-gray-200 p-4 mb-6">
                            <div class="text-lg font-semibold text-gray-700 mb-2">Question Description</div>
                            <div class="bg-white p-4 shadow-inner">
                                <p class="text-gray-900 leading-relaxed">{!! $selectedQuestion->question_text !!}</p>
                            </div>
                        </div>

                        <!-- Options Row -->
                        <div class="space-y-2">
                            @foreach($selectedQuestion->questionOptions as $option)
                                <div class="flex items-center justify-between bg-gray-50 border border-gray-200 p-4 shadow">
                                    <div class="flex-1">
                                        <p class="text-gray-800 font-medium">{{ $option->options_text }}</p>
                                    </div>
                                    <div>
                                        <!-- Checkmark icon for correct answer -->
                                        @if($option->is_correct)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </x-modal>


    </div>
</div>
