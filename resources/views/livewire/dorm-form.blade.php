<div class="card">
    <div class="card-header font-semibold text-xl text-gray-800 leading-tight">ข้อมูลหอพัก</div>
    <div class="card-body">
        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
        <div class=" flex items-center justify-center">
            <div class="row justify-center">
                <div class="col">

                    <!-- Profile Photo File Input -->
                    {{--
                    <x-jet-label for="photo" value="{{ __('รูป') }}" /> --}}
                    <div wire:loading wire:target='photo' wire:key='photo'>
                        <i class="fa fa-spiner fa-spin mt-2 ml-2">Uploading...</i>
                    </div>
                    <!-- New Profile Photo Preview -->
                    @if ($dbphoto || $photo)
                    <div class=" flex items-center justify-center">
                        <div class="row justify-center">
                            <div class="mt-2 items-center">
                                <img src="{{empty(!$photo) ? $photo->temporaryUrl() : asset($dbphoto) }} " width='200'
                                    height='200'>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class=" flex items-center justify-center">
                        <div class="row justify-center">
                            <div class="mt-2 items-center">
                                <img src="{{asset('images/buildings.png')}}" alt="" width='200' height='200'>
                            </div>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="photo" wire:model='photo' class="form-control mt-4">

                    <x-jet-input-error for="photo" class="mt-2" />
                </div>


            </div>
        </div>
        <div class="flex items-center justify-center mt-4">
            <div class="row justify-center">
                <div class="col-6">
                    <div class="form-group ">
                        <x-jet-label for="name" value="{{ __('ชื่อ') }}" />
                        <input type="text" name="name" class="form-control" id="name" wire:model='name' required
                            autofocus>
                    </div>
                    <x-jet-input-error for="name" class="mt-2" />

                    <div class="form-group mt-4">
                        <x-jet-label for="address" value="{{ __('รายละเอียดที่อยู่') }}" />
                        <input type="address" name="address" class="form-control" id="address" required
                            wire:model='address' autofocus>
                    </div>
                    <x-jet-input-error for="address" class="mt-2" />

                    {{-- Province --}}
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="province" value="{{ __('จังหวัด') }}" />
                        <select id="province" class="form-control text-s" name="province" required autofocus
                            autocomplete="province" wire:model="province">
                            <option value=""></option>
                            @foreach ($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                            @endforeach
                        </select>

                    </div>

                    {{-- Amphure --}}
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="amphure" value="{{ __('อำเภอ/เขต') }}" />
                        <select id="amphure" class="form-control text-s" name="amphure" :value="old('amphure')" required
                            autofocus autocomplete="amphure" wire:model="amphure">
                            <option value=""></option>
                            @foreach ($amphures as $item)
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- District --}}
                    <div class="col-span-6 sm:col-span-4 mt-4">
                        <x-jet-label for="district" value="{{ __('ตำบล/แขวง') }}" />
                        <select id="district" class="form-control text-s" name="district" :value="old('district')"
                            autocomplete="district" wire:model="district">
                            <option value=""></option>
                            @foreach ($districts as $item)
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <div class="col-6">

                    <div class="form-group">
                        <x-jet-label for="phone" value="{{ __('เบอร์โทรศัพท์') }}" />
                        <input type="text" name="phone" class="form-control" id="phone" wire:model='phone' required
                            autofocus>
                    </div>
                    <x-jet-input-error for="phone" class="mt-2" />

                    <div class="form-group  mt-4">
                        <x-jet-label for="electricity_per_unit" value="{{ __('ค่าไฟ/หน่วย') }}" />
                        <input type="number" name="electricity_per_unit" class="form-control " id="electricity_per_unit"
                            wire:model='electricity_per_unit' required autofocus>
                    </div>
                    <x-jet-input-error for="electricity_per_unit" class="mt-2" />

                    <div class="form-group mt-4">
                        <x-jet-label for="water_per_unit" value="{{ __('ค่าน้ำ/หน่วย') }}" />
                        <input type="number" name="water_per_unit" class="form-control" id="water_per_unit"
                            wire:model='water_per_unit' required autofocus>
                    </div>
                    <x-jet-input-error for="water_per_unit" class="mt-2" />

                    <div class="form-group mt-4">
                        <x-jet-label for="water_pay_min" value="{{ __('ค่าน้ำแบบเหมา (ถ้ามี)') }}" />
                        <input type="number" name="water_pay_min" class="form-control" id="water_pay_min"
                            wire:model='water_pay_min'>
                    </div>
                    <x-jet-input-error for="water_pay_min" class="mt-2" />

                    <div class="form-group mt-4">
                        <x-jet-label for="water_min_unit" value="{{ __('หน่วยค่าน้ำแบบเหมา (ถ้ามี)') }}" />
                        <input type="number" name="water_min_unit" class="form-control" id="water_min_unit"
                            wire:model='water_min_unit'>
                    </div>
                    <x-jet-input-error for="water_min_unit" class="mt-2" />

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4 mr-2">
        <div class="flex items-center justify-center">
            <x-jet-button class="btn btn-success" wire:loading.attr="disabled" wire:target="photo">
                {{ __('บันทึกข้อมูล') }}
            </x-jet-button>
        </div>
    </div>
</div>
