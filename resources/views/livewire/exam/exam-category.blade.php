<div class="py-5 bg-gray-100">
    <x-card class="w-full max-w-full bg-white p-6 rounded-lg shadow-lg">
        <x-card-header title="" class="text-right mb-2">
            @if(Auth::user()->can('ExamCategory.create'))
                <x-button label="Add" icon="plus" green outline link="{{ route('admin.examcategory-create')}}" />
            @endif
        </x-card-header>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-center">
                <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 text-sm font-medium">#</th>
                    <th class="py-3 px-4 text-sm font-medium">Category Name</th>
                    <th class="py-3 px-4 text-sm font-medium">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr class="border-t border-gray-200">
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $category->id }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $category->name }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">

                            @if(Auth::user()->can('ExamCategory.edit'))
                                <a href="{{ route('admin.examcategory-edit',$category->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            @endif

                            @if(Auth::user()->can('ExamCategory.delete'))
                                | <a href="#" class="text-red-500 hover:text-red-700" wire:confirm="Are you sure !"  wire:click="delete({{ $category->id }})">Delete</a>
                            @endif


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
               {{ $categories->links('pagination::tailwind') }}
            </div>
        </div>
    </x-card>
</div>
