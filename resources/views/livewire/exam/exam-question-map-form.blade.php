<div class="py-5 bg-gray-100">
    <!-- Wrapper Div to ensure a single root element -->
    <div>
        <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
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
                    @foreach($questionsList as $question)
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
                                @if(Auth::user()->can('Question.create'))
                                    @if(!$question->map_id)
                                      <a href="#" class="text-blue-500 hover:text-blue-700" wire:confirm="Do you want to add this question!" wire:click="addQuestion({{ $question->id }})">Add</a>
                                    @endif
                                @endif
                                @if(Auth::user()->can('Question.delete'))
                                     @if($question->map_id)
                                       <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure!" wire:click="deleteQuestion({{ $question->id }})">Delete</a>
                                     @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $questionsList->links('pagination::tailwind') }}
                </div>
            </div>
        </x-card>

    </div>
</div>
