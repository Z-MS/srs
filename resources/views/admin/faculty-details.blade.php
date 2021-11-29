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
                    <form method="POST" @submit.prevent="submitData" id="new-fac-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                            </div>
                            
                            <div>
                                <x-label for="code" :value="__('Code')" />
                                <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                            </div>
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
    </div>
</x-admin-dash>