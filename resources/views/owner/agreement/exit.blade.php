<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'ยกเลิกสัญญาห้อง : '.$agreement->room->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('show-agreement-now', ['agreement' =>$agreement,"room"=>$agreement->room ,'page'=>2])

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {{-- Form --}}
                <div class="col-md-12">
                    <form action="{{ route('agreement.exit.status') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$agreement->id}}">
                        @livewire('agreement-exit-form',)
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
