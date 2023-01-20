<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'รายละเอียดห้องพัก : '.$room->name }}
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
            @livewire('show-agreement-now', ['agreement' =>$agreement,"room"=>$room ,'page'=>0])
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {{-- Table --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายการบิลค่าเช่า</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        <div class="flex items-center justify-center mb-2 px-20">
                                            @if ($agreement->status=="ยอมรับ")
                                            @if ($agreement->agreementShowStatus()=="อยู่ในสัญญา")
                                            <a href="{{ route('bill.create', ['id'=>$agreement->id]) }}"
                                                class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold"
                                                type="button">
                                                {{ __('เพิ่มบิลค่าเช่า') }}
                                            </a>
                                            @else
                                            <h5 class="font-semibold " style="color: red">
                                                {{$agreement->agreementShowStatus()}}</h5>
                                            @endif

                                            @else
                                            <h5 class="font-semibold " style="color: red">
                                                รอการยืนยันสัญญาจากผู้เช่า</h5>
                                            @endif
                                        </div>
                                        @livewire('bill-table', ['agreement' => $agreement])
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
