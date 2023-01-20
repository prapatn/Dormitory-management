<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($dormitory->name.' : จัดการห้องพัก') }}
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
                {{-- Detail --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายละเอียดหอพัก</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-2 px-20">
                                            <div class="grid grid-cols-1 md:grid-cols-{{$dormitory->image?" 2":"1"}}
                                                lg:grid-cols-{{$dormitory->image?"2":"1"}}
                                                xl:grid-cols-{{$dormitory->image?"2":"1"}} gap-8 md:gap-8">

                                                @if ($dormitory->image)
                                                <div class="mr-5" style=" text-align:center">
                                                    <img src="{{ $dormitory->image?asset($dormitory->image):asset('images/buildings.png') }}"
                                                        class="hover:shadow-lg rounded-md h-48 w-full object-contain rounded-b-none ">
                                                    <h5 class=" font-bold leading-6 text-gray-900 mt-2">
                                                        {!! $dormitory->name !!}
                                                    </h5>
                                                </div>
                                                @endif

                                                <div>
                                                    <h6>ที่อยู่ : {{$dormitory->getFullAddress() }} </h6>
                                                    <h6>ค่าไฟ : {{$dormitory->electricity_per_unit }} (บาท/หน่วย)
                                                    </h6>
                                                    @if ($dormitory->water_min_unit==null)
                                                    <h6>ค่าน้ำ : {{$dormitory->water_per_unit }} (บาท/หน่วย) </h6>
                                                    @else
                                                    <h6>ค่าน้ำ : เหมาจ่าย {{$dormitory->water_min_unit}} หน่วยแรก
                                                        {{$dormitory->water_pay_min }} บาท/ห้อง (ส่วนเกิน
                                                        {{$dormitory->water_per_unit }} บาท/หน่วย)</h6>
                                                    @endif
                                                    <h6>สร้างเมื่อ : {{
                                                        $dormitory->created_at->format('d/m/Y')
                                                        }}
                                                    </h6>
                                                    <h6>อัพเดทล่าสุด :
                                                        {{
                                                        $dormitory->updated_at->format('H:i น. d/m/Y')
                                                        }}
                                                    </h6>
                                                    @if ($dormitory->payment_number==null &&
                                                    $dormitory->payment_image==null)
                                                    <h6 class="font-semibold " style="color: red">ช่องทางการจ่ายเงิน :
                                                        กรุณาเพิ่มข้อมูล</h6>
                                                    @else
                                                    <div class="row">
                                                        <div class="col">
                                                            <h6>บัญชี : {{$dormitory->bank_name."
                                                                ".$dormitory->payment_number
                                                                }}</h6>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <a href="{{ route('dorm.payment', ['id'=>$dormitory->id]) }}"
                                                        class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold float-end mt-2"
                                                        type="button">
                                                        {{ __('จัดการช่องทางการจ่ายเงิน') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {{-- Table --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายการห้องพัก</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-4">
                                            @if ($dormitory->payment_number==null &&
                                            $dormitory->payment_image==null)
                                            <h5 class="font-semibold " style="color: red">
                                                กรุณาเพิ่มข้อมูลช่องทางการจ่ายเงิน</h5>
                                            @else
                                            <a href="{{ route('room.create', ['id'=>$dormitory->id]) }}"
                                                class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold"
                                                type="button">
                                                {{ __('เพิ่มข้อมูลห้องพักใหม่') }}</a>
                                            @endif
                                        </div>
                                        @livewire('rooms-table-view', ['dorm_id' => $dormitory->id])
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
