<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$dormitory->name.' : จัดการห้องพัก' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Form --}}
                <div class="col-md-12">
                    <form action="{{ route('room.store') }}" method="post" enctype="multipart/form-data">
                        <input type="text" hidden name="dorm_id" value="{{ $dormitory->id}}">
                        @livewire('room-form', ['dorm_id' => $dormitory->id,'room'=>null])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
