<div class="py-5 bg-gray-100">
    <div>
        <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
            <x-card-header class="mb-4" title="">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Search exams title..."
                            class="form-input w-64 px-3 py-2 border rounded-md"
                        >
                    </div>

                    @if(Auth::user()->can('Exam.create'))
                        <x-button
                            label="Add Exam"
                            icon="plus"
                            green
                            outline
                            link="{{ route('admin.exam-create') }}"
                        />
                    @endif
                </div>
            </x-card-header>

            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-center">
                    <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th>#</th>
                        <th>Title</th>
                        <th class="py-3 px-4 text-sm font-medium">Exam Date</th>
                        <th class="py-3 px-4 text-sm font-medium">Duration</th>
                        <th class="py-3 px-4 text-sm font-medium">Status</th>
                        <th class="py-3 px-4 text-sm font-medium">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr class="border-t border-gray-200">
                            <td class="py-3 px-4 text-sm text-gray-800">
                                {{ $exam->id }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                {{ $exam->title }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                {{ \Carbon\Carbon::parse($exam->exam_date)->format('d M Y') }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                {{ $exam->duration }} minutes
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                    <span class="
                                        px-2 py-1 rounded
                                        {{ $exam->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}
                                    ">
                                        {{ ucfirst($exam->status) }}
                                    </span>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                @if(Auth::user()->can('ExamQuestionSet.view'))
                                    <a
                                        href="{{ route('admin.exam-question-map-create', $exam->id) }}"
                                        class="text-purple-500 hover:text-purple-700"
                                    >
                                        Set Question
                                    </a> |
                                @endif
                                @if(Auth::user()->can('Exam.view'))
                                    <a
                                        href="#"
                                        wire:click="viewDetails({{ $exam->id }})"
                                        class="text-yellow-500 hover:text-yellow-700"
                                    >
                                        View
                                    </a> |
                                @endif
                                @if(Auth::user()->can('Exam.edit'))
                                    <a
                                        href="{{ route('admin.exam-edit', $exam->id) }}"
                                        class="text-blue-500 hover:text-blue-700"
                                    >
                                        Edit
                                    </a>
                                @endif
                                @if(Auth::user()->can('Exam.delete'))
                                    | <a
                                        href="#"
                                        class="text-red-500 hover:text-red-700"
                                        wire:confirm="Are you sure you want to delete this exam?"
                                        wire:click="delete({{ $exam->id }})"
                                    >
                                        Delete
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $exams->links('pagination::tailwind') }}
                </div>
            </div>
        </x-card>


        <x-modal wire:model="myModal" 4xl>
            <x-exam-details :selectedExam="$selectedExam" />
        </x-modal>






    </div>
</div>
