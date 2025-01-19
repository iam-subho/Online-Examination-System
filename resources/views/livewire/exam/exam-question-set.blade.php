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
                    @foreach($questions_list as $question_map)
                        @php
                            if(strpos($question_map->question->question_text, '<img') !== false){
                                $content = "<p>Question Contain Image</p>";
                            }else{
                                $content = $question_map->question->question_text;
                            }
                        @endphp
                        <tr class="border-t border-gray-200">
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question_map->id }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question_map->question->question_type }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question_map->question->difficulty }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $question_map->points??$question_map->question->points }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{!!  $content !!}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                @if(Auth::user()->can('Question.view'))
                                    <a href="#" wire:click="viewDetails({{ $question_map->id }})" class="text-yellow-500 hover:text-yellow-700" wire:loading.attr="disabled">View Details</a> |
                                @endif
                                @if(Auth::user()->can('Question.edit'))
                                    <a href="{{ route('admin.question-edit', $question_map->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                @endif
                                @if(Auth::user()->can('Question.delete'))
                                    | <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure!" wire:click="delete({{ $question_map->id }})">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $questions_list->links('pagination::tailwind') }}
                </div>
            </div>
        </x-card>



    </div>
</div>
