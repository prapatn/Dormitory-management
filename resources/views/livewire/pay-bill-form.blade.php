<div>
    <div class=" flex items-center justify-center">
        <div class="row justify-center" style="text-align: start">
            <div class="col">
                <h6 class="text-xl font-semibold mb-2">{{ __('หลักฐานการโอน') }}</h6>
                <!-- Profile Photo File Input -->
                <div wire:loading wire:target='photo' wire:key='photo'>
                    <i class="fa fa-spiner fa-spin mt-2 ml-2">Uploading...</i>
                </div>
                <!-- New Profile Photo Preview -->
                @if ($dbphoto || $photo)
                <div class=" flex items-center justify-center">
                    <div class="row justify-center">
                        <div class=" items-center">
                            <img src="{{empty(!$photo) ? $photo->temporaryUrl() : asset($dbphoto) }} " width='200'
                                height='200' class="h-48 w-full object-contain">
                        </div>
                    </div>
                </div>
                @else
                <div class=" flex items-center justify-center">
                    <div class="row justify-center">
                        <div class=" items-center">
                            <img src="{{asset('images/bill.png')}}" alt="" width='200' height='200'
                                class="h-48 w-full object-contain">
                        </div>
                    </div>
                </div>
                @endif
                <input type="file" name="photo" wire:model='photo' class="form-control mt-4">
                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        </div>
    </div>
    <x-jet-button class="mt-4 btn btn-success" wire:loading.attr="disabled" wire:target="photo">
        {{ __('บันทึกข้อมูล') }}
    </x-jet-button>
</div>
