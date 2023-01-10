<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ข้อมูลสัญญาเช่าห้อง') }}
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
                        <div class="card-header text-xl font-semibold">ตารางรายการสัญญาเช่าห้อง</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        @if ($agreements)
                                        <table class="table table-striped mt-2">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>สร้างเมื่อ</th>
                                                    <th>หอพัก</th>
                                                    <th>ห้อง</th>
                                                    <th>ชั้น</th>
                                                    <th>ค่าเช่า/ค่าประกัน</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($agreements as $row)
                                                <tr>

                                                    <td>
                                                        {{ $row->created_at->format('H:i น. d/m/Y') }}
                                                    </td>
                                                    <td>{{ $row->dormitory($row->room->dorm_id)->name}}</td>
                                                    <td>{{$row->room->name}}</td>
                                                    <td>{{$row->room->floor}}</td>
                                                    <td>{{$row->room->price}}/{{$row->price_guarantee}}</td>
                                                    <td>
                                                        @if ($row->status=="รอยืนยัน")
                                                        <a href="{{ route('agreement.status', ['id'=>$row->id,'status'=>"
                                                            ยอมรับ"]) }}" class="btn btn-success"
                                                            onclick="return confirm('ต้องการยอมรับสัญญาหรือไม่')">ยอมรับสัญญา
                                                        </a>
                                                        <a href="{{ route('agreement.status', ['id'=>$row->id,'status'=>"
                                                            ปฏิเสธ"]) }}" class="btn btn-danger"
                                                            onclick="return confirm('ต้องการไม่ยอมรับนี้หรือไม่')">ปฏิเสธสัญญา
                                                        </a>
                                                        @else
                                                        <div class="font-semibold ">
                                                            {{$row->status}}
                                                        </div>
                                                        @endif

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- Tab page --}}
                                        <div class="mt-4">
                                            {{ $agreements->links() }}
                                        </div>
                                        @else
                                        <div class="flex items-center justify-center">
                                            <h5 class="font-semibold " style="color: red">
                                                ยังไม่มีข้อมูลสัญญา</h5>
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
