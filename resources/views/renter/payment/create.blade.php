<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'รายละเอียดบิลห้อง : '. $bill->agreement->room->name ." (".date('d/m/Y',
            strtotime($bill->updated_at)).")"}}
        </h2>
    </x-slot>

    @livewire('detail-bill-card', ['bill' => $bill,'user'=>$user])

    <div class="pt-3 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Form --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">ข้อมูลหลักฐานการจ่ายค่าเช่า</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-2 px-20">
                                            <div
                                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 md:gap-8">
                                                <div class="mr-5" style=" text-align:center">
                                                    <div style="text-align: start">
                                                        <h6 class="text-xl font-semibold mb-2">{{ __('ช่องทางการโอน') }}
                                                        </h6>
                                                    </div>
                                                    <img src="{{ $bill->agreement->room->dormitory->payment_image?asset($bill->agreement->room->dormitory->payment_image):asset('images/qr-code.png') }}"
                                                        class="rounded-md h-48 w-full object-contain rounded-b-none ">
                                                    <h6 class="mt-4 mb-4">
                                                        หรือ
                                                    </h6>
                                                    <h5 class=" font-bold leading-6 text-gray-900 mt-2">
                                                        {!! $bill->agreement->room->dormitory->bank_name . " " .
                                                        $bill->agreement->room->dormitory->payment_number !!}
                                                    </h5>
                                                    <h5 class=" font-bold leading-6 text-gray-900 mt-2">
                                                        {!! "ค่าเช่ารวมของเดือนนี้ " .
                                                        $bill->calAll() ." บาท" !!}
                                                    </h5>
                                                </div>
                                                <div class="ml-5" style=" text-align:center">
                                                    <form action="{{ route('payment.store') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
                                                        <input type="text" hidden name="bill_id" value="{{$bill->id}}">
                                                        @if ($bill->payment)
                                                        <input type="text" hidden name="id"
                                                            value="{{$bill->payment->id}}">
                                                        @endif
                                                        @livewire('pay-bill-form', ['bill' => $bill])
                                                    </form>
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
</x-app-layout>
