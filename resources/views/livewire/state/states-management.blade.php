<div class="py-5 bg-gray-100">
    <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
        <x-card-header title="" class="text-right mb-2">
            @if(Auth::user()->can('State.create'))
               <x-button label="Add" icon="plus" green outline link="{{ route('admin.states-create')}}" />
            @endif
        </x-card-header>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-center">
                <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 text-sm font-medium">#</th>
                    <th class="py-3 px-4 text-sm font-medium">State Name</th>
                    <th class="py-3 px-4 text-sm font-medium">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($states as $state)
                    <tr class="border-t border-gray-200">
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $state->id }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $state->name }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">

                            @if(Auth::user()->can('District.view'))
                                <a href="#" class="text-yellow-500 hover:text-yellow-700">Dist List</a> |
                            @endif

                            @if(Auth::user()->can('State.edit'))
                                 <a href="{{ route('admin.states-edit',$state->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            @endif

                            @if(Auth::user()->can('State.delete'))
                                | <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure !"  wire:click="delete({{ $state->id }})">Delete</a>
                            @endif


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
{{--            <div class="mt-4">--}}
{{--                {{ $states->links('pagination::tailwind') }}--}}
{{--            </div>--}}
        </div>
    </x-card>
</div>
