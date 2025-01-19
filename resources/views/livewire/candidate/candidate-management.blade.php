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
                        <th class="py-3 px-4 text-sm font-medium">Name</th>
                        <th class="py-3 px-4 text-sm font-medium">Gender</th>
                        <th class="py-3 px-4 text-sm font-medium">Email</th>
                        <th class="py-3 px-4 text-sm font-medium">Phone</th>
                        <th class="py-3 px-4 text-sm font-medium">District</th>
                        <th class="py-3 px-4 text-sm font-medium">School</th>
                        <th class="py-3 px-4 text-sm font-medium">Status</th>
                        <th class="py-3 px-4 text-sm font-medium">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allCandidates as $candidate)

                        <tr class="border-t border-gray-200">
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->id }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->gender }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->email }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->phone }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->district->name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->school->name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">{{ $candidate->status }}</td>
                            <td class="py-3 px-4 text-sm text-gray-800">
                                @if(Auth::user()->can('Candidate.view'))
                                    <a href="#" wire:click="viewDetails({{ $candidate->id }})" class="text-yellow-500 hover:text-yellow-700" wire:loading.attr="disabled">View Details</a> |
                                @endif
                                @if(Auth::user()->can('Candidate.edit'))
                                    <a href="{{ route('admin.candidate.edit', $candidate->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                @endif
                                @if(Auth::user()->can('Candidate.delete'))
                                    | <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure!" wire:click="delete({{ $candidate->id }})">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $allCandidates->links('pagination::tailwind') }}
                </div>
            </div>
        </x-card>



    </div>
</div>
