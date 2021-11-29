<x-admin-dash>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Faculties') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mx-10" x-data="addNewForm()" 
                        @set-open="openPopup($event)"
                        @set-close="closePopup"
                    >
                        <template x-if="openEdit">
                            <x-popup title="Confirm Delete" id="viewdit"></x-popup>
                        </template>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded"
                        x-ref="modal1_button" @click="open = true">Add Faculty</button>
                      

                        <div role="dialog"
                            aria-labelledby="modal1_label"
                            aria-modal="true"
                            tabindex="0"
                            x-cloak
                            x-show="open"
                            @click="open = false; $refs.modal1_button.focus()"
                            @click.away="open = false"
                            class="fixed top-0 left-0 w-full h-screen flex justify-center items-center">
                            <div aria-hidden="true"
                                 class="absolute top-0 left-0 w-full h-screen bg-black transition duration-300"
                                 :class="{ 'opacity-60': open, 'opacity-0': !open }"
                                 x-show="open"
                                 x-transition:leave="delay-150"></div>
                            <div data-modal-document
                                 @click.stop=""
                                 x-show="open"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="transform scale-50 opacity-0"
                                 x-transition:enter-end="transform scale-100 opacity-100"
                                 x-transition:leave="transition ease-out duration-300"
                                 x-transition:leave-start="transform scale-100 opacity-100"
                                 x-transition:leave-end="transform scale-50 opacity-0"
                                 class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white w-3/5 h-3/5 z-10">
                                <div class="p-6 border-b">
                                    <h2 class="font-bold" id="modal1_label" x-ref="modal1_label">Add Faculty</h2>
                                </div>
                                <div class="p-6">
                                    <form method="POST" @submit.prevent="submitData" id="new-fac-form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div>
                                            <x-label for="name" :value="__('Name')" />
                                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                                        </div>
                            
                                        <div class="mt-4">
                                            <x-label for="code" :value="__('Code')" />
                                            <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                                        </div>
                                        
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button class="ml-4">
                                                {{ __('Submit') }}
                                            </x-button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div id="showfaculties">
                            @include('admin.processes.faculties')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addNewForm() {
            return {
                open: false,
                openEdit: false,
                openNew: false,
                form: document.querySelector('#new-fac-form'),
                message: '',
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
                    fetch("{{ route('faculties') }}", {
				        method: 'POST',
                        body: new FormData(this.form)
                    }).then((response) => {
                        this.open = !this.open
                        this.form.reset()
                        response.text().then((text) => {
                            var table = document.querySelector('#showfaculties')
                            table.innerHTML = ''
                            table.innerHTML = text
                        })
                    })
                }
            }
        }
    </script>
</x-admin-dash>
