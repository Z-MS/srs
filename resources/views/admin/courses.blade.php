<x-admin-dash>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mx-10" x-data="{ open: false }">
                            <button @click="open = !open" class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded">Add Course</button>

                        <table class="border divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-6 py-2 text-sm text-gray-500">Title</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Code</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Department</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Faculty</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Level</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="whitespace no-wrap">
                                        <td class="px-6 py-4">{{ $course->title }}</td>
                                        <td class="px-6 py-4">{{ $course->code }}</td>
                                        <td class="px-6 py-4">{{ $course->department }}</td>
                                        <td class="px-6 py-4">{{ $course->faculty }}</td>
                                        <td class="px-6 py-4">{{ $course->level }}</td>
                                        <td class="px-6 py-4">{{ $course->units }}</td>
                                    </tr>
                                @endforeach       
                            </tbody>
                        </table>
                        <span x-show="open">
                            Ello gov'nor
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-dash>
