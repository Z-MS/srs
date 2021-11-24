<x-admin-dash>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff List') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mx-10">
                        <table class="divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-6 py-2 text-sm text-gray-500">Name</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Email</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Department</th>
                                    <th class="px-6 py-2 text-sm text-gray-500">Rank</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $staf)
                                    <tr class="whitespace no-wrap">
                                        <td class="px-6 py-4">{{ $staf->name }}</td>
                                        <td class="px-6 py-4">{{ $staf->email }}</td>
                                        <td class="px-6 py-4">{{ $staf->department }}</td>
                                        <td class="px-6 py-4"></td>
                                    </tr>
                                @endforeach       
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</x-admin-dash>
