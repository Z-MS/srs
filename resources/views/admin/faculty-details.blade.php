<x-admin-dash>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculty of '. $faculty->name) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-4 text-xl font-bold">Details</h3>
                    <form method="POST" @submit.prevent="submitData" id="new-fac-form" enctype="multipart/form-data">
                        @method('PUT')
                        {{ csrf_field() }}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $faculty->name }}" required />
                            </div>
                            
                            <div>
                                <x-label for="code" :value="__('Code')" />
                                <x-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{ $faculty->code }}" required />
                            </div>
                        </div>
                                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>

                <div class="p-6 bg-white border-b border-gray-200" x-data="handleData()"
                    @set-open="openPopup($event)"
                    @set-close="closePopup">
                    <h4 class="mb-4 text-lg font-bold">Departments</h4>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded"
                    @click="$dispatch('set-open', { openNew: true })">Add Department</button>
                    <template x-if="openNew">
                        <x-popup title="Add Department">
                            <form method="POST" @submit.prevent="handleData().submitData(); $dispatch('set-close')" id="new-dep-form" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                                </div>
                            
                                <div class="mt-4">
                                    <x-label for="code" :value="__('Code')" />
                                    <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                                </div>

                                <input id="faculty" type="hidden" name="faculty" value="{{ $faculty->code }}"/>
                                        
                                <div class="flex items-center justify-end mt-4">
                                    <x-button class="ml-4">
                                        {{ __('Submit') }}
                                    </x-button>
                                </div>
                            </form>
                        </x-popup>
                    </template>

                    <table class="border divide-y divide-gray-300" id="departments">
                        <thead>
                            <tr>
                                <th class="px-6 py-2 text-sm text-gray-500">Name</th>
                                <th class="px-6 py-2 text-sm text-gray-500">Code</th>
                                <th class="px-6 py-2 text-sm text-gray-500">Levels</th>
                            </tr>
                        </thead>
                        <tbody id="deprows">
                            <x-table-row :items="courses" :fields="$fields"/>                 
                        </tbody>
                    </table>
    
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleData() {
            return {
                form: document.querySelector('#new-dep-form'),
                openEdit: false,
                openNew: false,
                closePopup() {
                    if(this.openNew)
                        this.openNew = false
                    else
                        this.openEdit = false
                },
                openPopup(event) {
                    if(event.detail.openNew)
                        this.openNew = true
                    else
                        this.openEdit = true;
                },
                submitData() {
                    fetch("{{ route('departments') }}", {
                        method: 'POST',
                        body: new FormData(this.form),
                        token: document.querySelector('#new-dep-form').elements.namedItem('_token').value
                    }).then((response) => {
                        this.form.reset()
                        response.text().then((text) => {
                            console.log(text)
                            var table = document.querySelector('#deprows')
                            // table.innerHTML = ''
                            table.innerHTML = text
                            this.closePopup()
                        })
                    })
                }
            }
        }
    </script>
</x-admin-dash>