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
                    <div class="mx-10" x-data="{ open: false }" @set-close="open = false">
                        <button @click="$dispatch('set-open', open = !open)" class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded">Add Course</button>
                        <template x-if="open">
                            <x-popup title="Add Course">
                                <form method="POST" @submit.prevent="submitData" id="new-course-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid grid-cols-3 mt-4 gap-3">
                                        <div>
                                            <x-label for="title" :value="__('Title')" />
                                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                                        </div>
                            
                                        <div>
                                            <x-label for="code" :value="__('Code')" />
                                            <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                                        </div>
                                        {{-- DYNAMIC FACULTY AND DEPARTMENT FIELDS --}}
                                        <div>
                                            <x-label for="department" :value="__('Department')" />
                                            <x-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" required />
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitData () {
            fetch("{{ route('courses') }}", {
                method: 'POST',
                body: new Form(this.form)
            }).then((response) => {
                response.text().then((text) => {
                    var tableRows = document.querySelector('#courserows')
                    tableRows.innerHTML = text
                })
                this.form.reset()
            })
        }
    </script>
</x-admin-dash>
