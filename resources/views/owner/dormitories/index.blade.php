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
                        <div class="card-header text-xl font-semibold">ตารางรายการหอพัก</div>
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
                                        <table class="table table-striped mt-2">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>รูป</th>
                                                    <th>ชื่อ</th>
                                                    <th>ที่อยู่</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dormitories as $row)
                                                <tr>
                                                    <th>{{ $dormitories->firstItem() + $loop->index }}</th>
                                                    <td>
                                                        @if ($row->image)
                                                        <img src="{{ asset($row->image) }}" alt="" width="100px"
                                                            height="100px">
                                                        @else
                                                        <img src="{{ asset('images/buildings.png') }}" alt=""
                                                            width="100px" height="100px">
                                                        @endif
                                                    </td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->getFullAddress(); }}</td>
                                                    <td>
                                                        <a href="{{ url('dormitories/edit/' . $row->id) }}"
                                                            class="btn btn-warning">แก้ไข</a>
                                                        <a href="{{ url('dormitories/delete/' . $row->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')">ลบ</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- Tab page --}}
                                        {{ $dormitories->links() }}
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
