<div class="card">
    <div class="card-header font-semibold text-xl text-gray-800 leading-tight">ข้อมูลยกเลิกสัญญา</div>
    <div class="card-body">
        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
        <div class="flex items-center justify-center mt-4">
            <div class="row justify-center">
                <div class="col-12">
                    <div class="mt-4">
                        <x-jet-label for="annotation" value="{{ __('หมายเหตุ') }}" />
                        <x-jet-input id="annotation" class="block mt-1 w-full h-10 " rows="5" type="text"
                            name="annotation" wire:model='annotation' autofocus required />
                        <x-jet-input-error for="annotation" class="mt-2" />
                    </div>

                    <div class="container mb-4 mr-2 mt-4">
                        <div class="flex items-center justify-center">
                            <x-jet-button class="btn btn-success" wire:loading.attr="disabled" wire:target="photo">
                                {{ __('บันทึกข้อมูล') }}
                            </x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
