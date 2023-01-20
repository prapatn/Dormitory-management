<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'ประวัติการจ่ายค่าเช่า'}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('Success'))
            <div class="alert alert-success">
                {{ session('Success') }}
            </div>
            @endif
            @if (session()->has('Fail'))
            <div class="alert alert-danger">
                {{ session('Fail') }}
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {{-- Table --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายการห้องพัก</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        @if (count($agreements)!=0)
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8 md:gap-8">
                                            @foreach ($agreements as $item)
                                            <div class="relative">
                                                <div class="rounded-md shadow-md">
                                                    <a href="{{ route('agreement.show', ['id'=>$item->id]) }}">
                                                        <img src="{{asset( $item->room->dormitory->image?$item->room->dormitory->image:'images/buildings.png') }}"
                                                            class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-contain rounded-b-none ">
                                                    </a>
                                                    <div class="pt-4 bg-white rounded-b-md p-4">
                                                        <div class="flex items-start">
                                                            <div class="flex-1">
                                                                <h6 class="font-bold leading-6 text-gray-900">
                                                                    <a href="{{ route('agreement.show', ['id'=>$item->id]) }}"
                                                                        class="text-decoration-none font-bold leading-6 text-gray-900 "
                                                                        role="text">
                                                                        {!!'ห้อง ' . $item->room->name ." หอพัก ".
                                                                        $item->room->dormitory->name !!}
                                                                    </a>

                                                                </h6>
                                                                <p class="line-clamp-3 mt-2">
                                                                    สัญญา : {{date('d/m/Y',
                                                                    strtotime($item->start_date))}} -
                                                                    {{date('d/m/Y', strtotime($item->end_date))}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        {{-- Tab page --}}
                                        <div class="mt-4">
                                            {{ $agreements->links() }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
