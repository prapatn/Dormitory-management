<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'รายละเอียดบิลห้อง : '. $bill->agreement->room->name ." (".date('d/m/Y',
            strtotime($bill->updated_at)).")"}}
        </h2>
    </x-slot>

    @if ($bill->payment)
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Detail --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">ข้อมูลหลักฐานการจ่ายค่าเช่า</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-2 px-20">
                                            <div class="grid grid-cols-1">
                                                <div class="mr-5" style=" text-align:center">
                                                    <div style="text-align: start">
                                                        <h6 class="text-xl font-semibold mb-2">{{ __('รูปหลักฐาน') }}
                                                        </h6>
                                                    </div>
                                                    <img src="{{asset($bill->payment->image)}}"
                                                        class="rounded-md h-48 w-full object-contain rounded-b-none ">
                                                    <h6 class="mt-4 mb-4">
                                                        {!! "ส่งหลักฐานเมื่อ : " . date('d-m-Y',
                                                        strtotime($bill->payment->updated_at)) !!}
                                                    </h6>
                                                    <h5 class=" font-bold leading-6 text-gray-900 mt-2">

                                                    </h5>
                                                    <h5 class=" font-bold leading-6 text-gray-900 mt-2">
                                                        {!! "ค่าเช่ารวมของเดือนนี้ " .
                                                        $bill->calAll() ." บาท" !!}
                                                    </h5>
                                                    @if ($bill->status == "ตรวจสอบแล้ว")
                                                    {{-- <a href="#" class="btn btn-success mt-4"></a> --}}
                                                    @else
                                                    <a href="{{ route('payment.edit', ['id'=>$bill->id]) }}"
                                                        class="btn btn-success mt-4">ตรวจสอบแล้ว</a>
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
    </div>
    @endif

    @livewire('detail-bill-card', ['bill' => $bill,'user'=>$user])
</x-app-layout>
