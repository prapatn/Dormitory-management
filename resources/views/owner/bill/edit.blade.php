<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'จัดการค่าเช่าห้อง : '. $bill->agreement->room->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Form --}}
                <div class="col-md-12">
                    <form action="{{ route('bill.update') }}" method="post" enctype="multipart/form-data">
                        <input type="text" hidden name="bill_id" value="{{$bill->id}}">
                        @livewire('bill-form', ['bill'=>$bill])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
