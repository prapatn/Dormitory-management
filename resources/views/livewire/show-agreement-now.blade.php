<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    {{-- Detail --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header  d-flex justify-content-between">
                <div class="text-xl font-semibold">
                    ข้อมูลสัญญาปัจจุบัน
                </div>
                <div>
                    @if ($agreement!=null)
                    @if ($agreement->status=="รอยืนยัน")
                    <a href="{{ route('agreement.edit', ['id'=>$agreement->id]) }}"
                        class="float-right sm border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">
                        <i data-feather="edit-2" class="sm">
                        </i>
                    </a>
                    @endif

                    @if ($this->page==1)
                    <a href="{{ route('room.show', ['id'=>$room->id]) }}" class="">
                        <x-ri-file-list-3-line
                            class="h-8 w-8 float-right sm border-2 border-transparent text-gray-600 mr-4 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out" />

                    </a>
                    @else
                    <a href="{{ route('agreement.index', ['id'=>$room->id]) }}" class="">
                        <x-iconpark-historyquery-o
                            class="h-8 w-8 float-right sm border-2 border-transparent text-gray-600 mr-4 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out" />
                    </a>
                    @endif

                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="py-6">
                    <div class="container">
                        <div class="row">
                            <div class="flex items-center justify-center mb-2 px-20">
                                <div class="flex items-center justify-center mb-2 px-20">
                                    @if ($agreement!=null)
                                    <div
                                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 md:gap-8">
                                        <div class="mr-5" style=" text-align:center">
                                            <img src="{{
                                            asset($agreement->image?$agreement->image : "images/agreement.png") }}"
                                                class="hover:shadow-lg rounded-md h-full w-full  rounded-b-none ">
                                        </div>
                                        <div>
                                            <h5 class="font-bold leading-6 text-gray-900 mt-2">
                                                {!! 'ห้อง : '. $room->name !!}
                                            </h5>
                                            <h6>ชั้น : {{$room->floor }} </h6>
                                            <h6>ราคา : {{$room->price }} บาท/เดือน ค่าประกัน :
                                                {{$agreement->price_guarantee }} บาท</h6>

                                            <h6>ผู้เช่า : {{$agreement->user->name }} </h6>
                                            <h6>วันเริ่มสัญญา : {{date('d/m/Y',
                                                strtotime($agreement->start_date))}}
                                            </h6>
                                            <h6>วันสิ้นสุดสัญญา : {{date('d/m/Y',
                                                strtotime($agreement->end_date))}}
                                            </h6>
                                            <h6>สถานะ :
                                                {{
                                                $agreement->agreementShowStatus()
                                                }}
                                                @if ($agreement->agreementShowStatus()=="อยู่ในสัญญา")
                                                ({{Carbon\Carbon::now()->format('d/m/Y')}})
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                    @else
                                    <a href="{{ route('agreement.create', ['id'=>$room->id]) }}"
                                        class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold float-end mt-2"
                                        type="button">
                                        {{ __('เพิ่มสัญญาเช่าห้องพักใหม่') }}</a>
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
