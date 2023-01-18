<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'รายละเอียดบิลห้อง : '. $bill->agreement->room->name ." (".date('d/m/Y',
            strtotime($bill->updated_at)).")"}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Detail --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header  d-flex justify-content-between">
                            <div class="text-xl font-semibold">
                                ข้อมูลบิล
                            </div>
                            <div>
                                @if ($bill->status=="รอจ่าย" && $user->role =="owner")
                                <a href="{{ route('bill.edit', ['id'=>$bill->id]) }}"
                                    class="float-right sm border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                                    <i data-feather="edit-2" class="sm">
                                    </i>
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-2 px-20">
                                            <div class="flex items-center justify-center mb-2 px-20">
                                                @if ($bill!=null)
                                                <div
                                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 md:gap-8">
                                                    <div class="mr-5" style=" text-align:center">
                                                        <img src="{{
                                        asset($bill->image?$bill->image : " images/bill.png") }}"
                                                            class="hover:shadow-lg rounded-md w-full h-full  rounded-b-none ">
                                                    </div>
                                                    <div>
                                                        <h5 class="font-bold leading-6 text-gray-900 mt-2">
                                                            {!! 'หอพัก : '. $bill->agreement->room->dormitory->name !!}
                                                            {!! 'ห้อง : '. $bill->agreement->room->name . ' ชั้น : '
                                                            . $bill->agreement->room->floor !!}
                                                        </h5>
                                                        <h5 class="font-bold leading-6 text-gray-900 mt-2">

                                                        </h5>
                                                        <h6>วันออกบิล : {{ date('d/m/Y', strtotime($bill->updated_at))
                                                            }} กำหนดชำระ : {{ date('d/m/Y',
                                                            strtotime($bill->pay_last_date)) }} </h6>
                                                        <h6>
                                                            ผู้เช่า : {{$bill->agreement->user->name}} เบอร์โทรศัพท์ :
                                                            {{$bill->agreement->user->phone}}
                                                        </h6>
                                                        <h6>
                                                            ที่อยู่ : {{$bill->agreement->user->fullAddress()}}
                                                        </h6>
                                                        <table class="table table-striped mt-2">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>รายละเอียด</th>
                                                                    <th>จำนวนหน่วย</th>
                                                                    <th>ราคาต่อหน่วย</th>
                                                                    <th>จำนวนเงิน (บาท)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>ค่าเช่า</td>
                                                                    <td>1</td>
                                                                    <td>{{$bill->agreement->room->price}}</td>
                                                                    <td>{{$bill->agreement->room->price}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ค่าไฟฟ้า</td>
                                                                    <td>{{$bill->calElectricityUnit()}} ( {{
                                                                        $bill->electricity_unit }} -
                                                                        {{$bill->electricity_unit_last}} )</td>
                                                                    <td>{{$bill->agreement->room->dormitory->electricity_per_unit}}
                                                                    </td>
                                                                    <td>{{$bill->calElectricity()}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ค่าน้ำ</td>
                                                                    <td>{{$bill->calWaterUnit()}} ( {{ $bill->water_unit
                                                                        }} - {{$bill->water_unit_last}} )</td>
                                                                    <td>{{$bill->agreement->room->dormitory->water_per_unit}}
                                                                    </td>
                                                                    <td>{{$bill->calWater()}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>อื่นๆ</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>{{$bill->pay_other}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>รวมทั้งหมด</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>{{$bill->calAll()}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>สถานะ</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>
                                                                        <h5 class="font-semibold "
                                                                            style="color: {{$bill->status=='รอจ่าย' ? "red" : ($bill->status=='รอตรวจสอบ' ? "orange" : 'green')}}">
                                                                            {{$bill->status}}</h5>
                                                                    </th>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <a href="#"
                                                            onclick="javascript:window.history.back(-1);return false;"
                                                            class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold float-end mt-2"
                                                            type="button">
                                                            {{ __('กลับ') }}</a>

                                                        @if ($bill->status == 'รอจ่าย'&&$user->role =="renter" )
                                                        <a href="{{ route('payment.create', ['id'=>$bill->id]) }}"
                                                            class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold float-end mt-2 mr-4"
                                                            type="button">
                                                            {{ __('จ่ายค่าเช่า') }}</a>
                                                        @endif
                                                    </div>
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
        </div>
    </div>
</x-app-layout>
