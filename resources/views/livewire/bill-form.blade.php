<div class="card">
    <div class="card-header font-semibold text-xl text-gray-800 leading-tight"> ข้อมูลค่าเช่า </div>
    <div class="card-body">
        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
        <div class=" flex items-center justify-center">
            <div class="row justify-center">
                <div class="col">
                    <!-- Profile Photo File Input -->
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
                                <img src="{{asset('images/bill.png')}}" alt="" width='200' height='200'>
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
                <div class="col">
                    <div class="form-group mt-4">
                        <x-jet-label for="electricity_unit_last" value="{{ __('หน่วยไฟฟ้าบิลที่แล้ว') }}" />
                        <input type="number" name="electricity_unit_last" class="form-control"
                            wire:model='electricity_unit_last' id="electricity_unit_last" autofocus required {{
                            $this->electricity_unit_last ==
                        null ?"": 'disabled' }}>
                        <input type="hidden" value="{{$this->electricity_unit_last}}" name="electricity_unit_last">
                        <x-jet-input-error for="electricity_unit_last" class="mt-2" />
                    </div>
                    <div class="form-group mt-4">
                        <x-jet-label for="electricity_unit" value="{{ __('หน่วยไฟฟ้า') }}" />
                        <input type="number" name="electricity_unit" class="form-control" id="electricity_unit"
                            wire:model='electricity_unit' autofocus required>
                        @if ($this->electricity_unit != null)
                        <input type="hidden" value="{{$this->electricity_unit}}" name="water_unit_last">
                        @endif
                        <x-jet-input-error for="electricity_unit" class="mt-2" />
                    </div>
                    <div class="form-group mt-4">
                        <x-jet-label for="water_unit_last" value="{{ __('หน่วยน้ำบิลที่แล้ว') }}" />
                        <input type="number" name="water_unit_last" class="form-control" id="water_unit_last" autofocus
                            required wire:model='water_unit_last' {{ $this->water_unit_last== null ?"":
                        'disabled' }}>
                        @if ($this->water_unit_last != null)
                        <input type="hidden" value="{{$this->water_unit_last}}" name="water_unit_last">
                        @endif
                        <x-jet-input-error for="water_unit_last" class="mt-2" />
                    </div>
                    <div class="form-group mt-4">
                        <x-jet-label for="water_unit" value="{{ __('หน่วยน้ำ') }}" />
                        <input type="number" name="water_unit" class="form-control" id="water_unit"
                            wire:model='water_unit' autofocus required>
                        <x-jet-input-error for="water_unit" class="mt-2" />
                    </div>

                    <div class="form-group mt-4">
                        <x-jet-label for="pay_other" value="{{ __('ค่าใช้จ่ายอื่นๆ (ถ้ามี )') }}" />
                        <input type="number" name="pay_other" class="form-control" id="pay_other"
                            wire:model='pay_other'>
                        <x-jet-input-error for="pay_other" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="pay_last_date"
                            value="{{ __('วันสุดท้ายก่อนมีค่าปรับ ( '. $this->agreement->penalty_per_day.' บาท/วัน )') }}" />
                        <x-jet-input id="pay_last_date" class="block mt-1 w-full" type="date" name="pay_last_date"
                            wire:model='pay_last_date' required />
                        <x-jet-input-error for="pay_last_date" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4 mr-2 mt-4">
        <div class="flex items-center justify-center">
            <x-jet-button class="btn btn-success" wire:loading.attr="disabled" wire:target="photo">
                {{ __('บันทึกข้อมูล') }}
            </x-jet-button>
        </div>
    </div>
</div>
