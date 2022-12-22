<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('จัดการหอพัก') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Table --}}
                <div class="col-md-12">
                    @if (session('Success'))
                    <div class="alert-success">
                        <b>{{ session('Success') }}</b>
                    </div>
                    @endif

                    @if (session('Fail'))
                    <div class="alert-danger">
                        <b>{{ session('Fail') }}</b>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางรายการหอพัก</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center">
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
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dormitories as $row)
                                                <tr>
                                                    <th>{{ $dormitories->firstItem() + $loop->index }}</th>
                                                    <td><img src="{{ asset($row->image) }}" alt="" width="100px"
                                                            height="100px"></td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->address }}</td>
                                                    <td>
                                                        {{-- <a href="{{ url('phone_profile/edit/' . $row->id) }}"
                                                            class="btn btn-warning">แก้ไข</a>
                                                        <a href="{{ url('phone_profile/delete/' . $row->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')">ลบ</a>
                                                        --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- Tab page --}}
                                        {{-- {{ $phone_profiles->links() }} --}}
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
