<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('จัดการหอพัก') }}
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

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Table --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายการหอพัก</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-4">
                                            <a href="{{ route('dorm.create') }}"
                                                class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold"
                                                type="button">
                                                {{ __('เพิ่มข้อมูลหอพักใหม่') }}</a>
                                        </div>
                                        @if (count($dormitories)!=0)
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8 md:gap-8">
                                            @foreach ($dormitories as $item)
                                            <div class="relative">
                                                <div class="rounded-md shadow-md">
                                                    <a href="{{ url('dormitories/show/' . $item->id) }}">
                                                        <img src="{{ $item->image?$item->image:asset('images/buildings.png') }}"
                                                            class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full  object-contain rounded-b-none ">
                                                    </a>
                                                    <div class="pt-4 bg-white rounded-b-md p-4">
                                                        <div class="flex items-start">
                                                            <div class="flex-1">
                                                                <h4 class="font-bold leading-6 text-gray-900">
                                                                    <a href="{{ url('dormitories/show/' . $item->id) }}"
                                                                        class="text-decoration-none font-bold leading-6 text-gray-900 "
                                                                        role="text">
                                                                        {!! $item->name !!}
                                                                    </a>

                                                                    <a href="{{ url('dormitories/delete/' . $item->id) }}"
                                                                        onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')"
                                                                        class="float-right sm border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                                                                        <i data-feather="trash-2" class="sm">
                                                                        </i>
                                                                    </a>
                                                                    <a href="{{ url('dormitories/edit/' . $item->id) }}"
                                                                        class="float-right sm border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                                                                        <i data-feather="edit-2" class="sm">
                                                                        </i>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <p class="line-clamp-3 mt-2">
                                                            {!! $item->getFullAddress() !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        {{-- Tab page --}}
                                        <div class="mt-4">
                                            {{ $dormitories->links() }}
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
