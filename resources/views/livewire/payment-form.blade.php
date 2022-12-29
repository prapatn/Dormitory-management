<div>
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
                    @if ($dormitory->payment_image || $photo)
                    <div class=" flex items-center justify-center">
                        <div class="row justify-center">
                            <div class="mt-2 items-center">
                                <img src="{{empty(!$photo) ? $photo->temporaryUrl() : asset($dormitory->payment_image) }} "
                                    width='200' height='200'>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class=" flex items-center justify-center">
                        <div class="row justify-center">
                            <div class="mt-2 items-center">
                                <img src="{{asset('images/qr-code.png')}}" alt="" width='200' height='200'>
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
                        <x-jet-label for="bank_name" value="{{ __('ธนาคาร') }}" />
                        <input type="text" name="bank_name" class="form-control" id="bank_name" wire:model='bank_name'
                            required autofocus>
                    </div>
                    <x-jet-input-error for="bank_name" class="mt-2" />
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <x-jet-label for="payment_number" value="{{ __('เลขบัญชี') }}" />
                        <input type="text" name="payment_number" class="form-control" id="payment_number"
                            wire:model='payment_number' required autofocus>
                    </div>
                    <x-jet-input-error for="payment_number" class="mt-2" />
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
