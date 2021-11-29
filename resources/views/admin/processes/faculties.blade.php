<table class="border divide-y divide-gray-300" x-data>
    <thead>
        <tr>
            <th class="px-6 py-2 text-sm text-gray-500">Name</th>
            <th class="px-6 py-2 text-sm text-gray-500">Code</th>
            <th class="px-6 py-2 text-sm text-gray-500">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $faculty)
        <tr class="whitespace no-wrap hover:bg-gray-200" >
            <td class="px-6 py-4">{{ $faculty->name }}</td>
            <td class="px-6 py-4">{{ $faculty->code }}</td>
            <td class="px-6 py-4"><a href="{{ '/faculty/'. $faculty->name }}" class="bg-blue-500 text-white p-1.5 rounded">View/Edit</a>
            <a @click="$dispatch('set-open', { openNew: false })" href="#" class="bg-red-500 text-white p-1.5 ml-2 rounded">Delete</a></td>
        </tr>  
        @endforeach
    </tbody>
</table>
