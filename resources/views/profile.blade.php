<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors/>
                    <x-success-message/>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @method('PUT')
                        @csrf
                        <p class="text-xl font-bold mb-3">Personal Details</p>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ auth()->user()->name }}" autofocus />
                                </div>
                                <div>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ auth()->user()->email }}" autofocus />
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <div>
                                    <x-label for="date_of_birth" :value="__('Date of birth')"/>
                                    <x-input id="dob" class="block mt-1 w-full" type="date" value="{{ auth()->user()->date_of_birth }}"/>    
                                </div>
                                <div>
                                    <x-label for="photo" :value="__('Profile Photo')" />
                                    <x-input id="photo" class="block mt-1 w-full" type="file" name="photo" value="{{ auth()->user()->photo ? 'Change Photo' : 'Upload Photo' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-4">
                            <div class="grid grid-rows-1">
                                <div>
                                    <x-label for="address" :value="__('Home Address')" />
                                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ auth()->user()->address }}" />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 mt-4 gap-2">
                            {{-- <div class="grid grid-rows-3 gap-6"> --}}
                                <div>
                                    <x-label for="state" :value="__('State')" />
                                    <x-input id="state" class="block mt-1 w-full" type="text" name="state" value="{{ auth()->user()->state }}" />
                                </div>
                                <div>
                                    <x-label for="lga" :value="__('LGA')" />
                                    <x-input id="lga" class="block mt-1 w-full" type="text" name="lga" value="{{ auth()->user()->lga }}" />
                                </div>
                                <div>
                                    <x-label for="gender" :value="__('Gender')" />
                                    <x-input id="gender" class="block mt-1 w-full" type="text" name="gender" value="{{ auth()->user()->gender }}" />
                                </div>
                                <div>
                                    <x-label for="faculty" :value="__('Faculty')" />
                                    <x-input id="faculty" class="block mt-1 w-full" type="text" name="faculty" value="{{ auth()->user()->faculty }}"/>
                                </div>
                                <div>
                                    <x-label for="department" :value="__('Department')" />
                                    <x-input id="department" class="block mt-1 w-full" type="text" name="department" value="{{ auth()->user()->department }}" />
                                </div>
                                <div>
                                    <x-label for="level" :value="__('Level')" />
                                    <x-input id="level" class="block mt-1 w-full" type="text" name="level" value="{{ auth()->user()->level }}" />
                                </div>
                                {{-- </div> --}}
                            </div>

                            <p class="text-xl font-bold mt-4 mb-2">Next of Kin</p>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <x-label for="nok_name" :value="__('Name')" />
                                    <x-input id="nok_name" class="block mt-1 w-full" type="text" name="nok_name" value="{{ auth()->user()->nok_name }}" />
                                </div>
                                <div>
                                    <x-label for="nok_address" :value="__('Address')" />
                                    <x-input id="nok_address" class="block mt-1 w-full" type="text" name="nok_address" value="{{ auth()->user()->nok_address }}" />
                                </div>
                                <div>
                                    <x-label for="nok_phone" :value="__('Phone')" />
                                    <x-input id="nok_phone" class="block mt-1 w-full" type="number" name="nok_phone" value="{{ auth()->user()->nok_phone }}" />
                                </div>
                            </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

