<table class="border divide-y divide-gray-300">
    <thead>
        <tr>
            <th class="px-6 py-2 text-sm text-gray-500">Name</th>
            <th class="px-6 py-2 text-sm text-gray-500">Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $faculty)
        <tr class="whitespace no-wrap">
            <td class="px-6 py-4">{{ $faculty->name }}</td>
            <td class="px-6 py-4">{{ $faculty->code }}</td>
        </tr>  
        @endforeach
    </tbody>
</table>