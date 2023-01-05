<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'จัดการห้องพัก : '.$room->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Form --}}
                <div class="col-md-12">
                    <form action="{{ route('room.update') }}" method="post" enctype="multipart/form-data">
                        <input type="text" hidden name="id" value="{{ $room->id}}">
                        <input type="text" hidden name="dorm_id" value="{{ $room->dorm_id}}">
                        @livewire('room-form', ['room'=>$room])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
