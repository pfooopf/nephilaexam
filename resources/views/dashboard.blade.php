<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <button id="open-modal" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">Create Task</button>

    <div class="py-6 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tasks</h3>
                <p class="mt-1 text-sm text-gray-500">A list of all your tasks.</p>
            </div>
            <div class="border-t border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="#" class="flex items-center space-x-2">
                                    <span>Title</span>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Due Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $task->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->duedate ? $task->duedate : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($task->completed === 1)
                                        <a href="{{ route('change_task_status',['id'=>$task->id]) }}" class="text-blue-500">Completed</a>
                                    @else
                                        <a href="{{ route('change_task_status',['id'=>$task->id]) }}" class="text-yellow-600">Pending</a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    {{-- <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form> --}}

                                    <a href="" class="text-green-600 hover:text-green-900">Edit</a>
                                    <a href="" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal backdrop -->
    <div id="modal-backdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity hidden" aria-hidden="true"></div>

    <!-- Modal container -->
    <div id="modal-container" class="fixed inset-0 z-10 flex items-center justify-center p-4 hidden">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create a New Task</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Fill in the details below to create a new task.</p>
                        </div>
                        <!-- Form content here -->
                        <form id="task-form">
                            <div class="mt-4">
                                <label for="task-title" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" id="task-title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            </div>
                            <div class="mt-4">
                                <label for="task-description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="task-description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>
                            <div class="mt-4">
                                <label for="task-duedate" class="block text-sm font-medium text-gray-700">Due Date</label>
                                <input type="datetime-local" id="task-duedate" name="duedate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" id="submit-button" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Create Task</button>
                <button type="button" id="close-modal" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
            </div>
        </div>
    </div>

</x-app-layout>

{{-- datatable script --}}
<script>
    if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#default-table", {
        searchable: false,
        perPageSelect: false
    });
}
</script>
{{-- modal script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.getElementById('open-modal');
        const closeModalButton = document.getElementById('close-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalContainer = document.getElementById('modal-container');
        
        openModalButton.addEventListener('click', function () {
            modalBackdrop.classList.remove('hidden');
            modalContainer.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', function () {
            modalBackdrop.classList.add('hidden');
            modalContainer.classList.add('hidden');
        });

        // Close modal when clicking outside the modal container
        modalBackdrop.addEventListener('click', function () {
            modalBackdrop.classList.add('hidden');
            modalContainer.classList.add('hidden');
        });
    });
</script>