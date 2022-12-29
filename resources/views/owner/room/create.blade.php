<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('จัดการห้องพัก') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Form --}}
                <div class="col-md-12">
                    <form action="{{route('dorm.store')}}" method="post" enctype="multipart/form-data">
                        {{-- @livewire('dorm-form', ['dorm_id' => null]) --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
