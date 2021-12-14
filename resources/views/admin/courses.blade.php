<div class="mx-10" x-data="{ open: false }" @set-close="open = false">
    <button @click="$dispatch('set-open', open = !open)" class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded">Add Course</button>
    <template x-if="open">
        <x-popup title="Add Course">
            <form method="POST" @submit.prevent="submitData(); $dispatch('set-close')" id="new-course-form" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-3 mt-4 gap-3">
                    <div class="col-span-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                    </div>
        
                    <div>
                        <x-label for="code" :value="__('Code')" />
                        <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                    </div>
                    {{-- DYNAMIC FACULTY AND DEPARTMENT FIELDS --}}

                    <div class="col-span-3">
                        <x-label for="faculty" :value="__('Faculty')" />
                        <select name="faculty" id="faculty" class="block mt-1 w-full" onchange="fetchDepartments()">
                            <option value="">Select Faculty</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->code }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-3">
                        <x-label for="department" :value="__('Department')" />
                        <select name="department" id="dep-select" class="block mt-1 w-full">
                            <x-options options=""/>
                        </select>
                    </div>

                    <div>
                        <x-label for="level" :value="__('Level')" />
                        <x-input id="level" class="block mt-1 w-full" type="text" name="level" :value="old('level')" required />
                    </div>

                    <div>
                        <x-label for="units" :value="__('Units')"/>
                        <x-input id="units" class="block mt-1 w-full" type="number" name="units" :value="old('units')" required/>
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </x-popup>
    </template>
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
        <tbody id="courserows">
            <x-table-row :items="$courses" :fields="$fields"/>      
        </tbody>
    </table>
</div>
<script>
    function submitData () {
        let form = document.querySelector('#new-course-form');
        fetch('/courses', {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': form.elements.namedItem('_token').value
            }
        }).then((response) => {
            response.text().then((text) => {
                console.log(text)
                var tableRows = document.querySelector('#courserows')
                tableRows.innerHTML = text
            })
        })
        form.reset()
    }

    function fetchDepartments() {
        var code = document.querySelector('#faculty').value;
        // console.log(code);
        fetch(`/deps/${code}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#new-course-form').elements.namedItem('_token').value
            }
        }).then((response) => {
            response.text().then((text) => {
                document.querySelector('#dep-select').innerHTML = text;
            })
        })
    }
    
</script>
