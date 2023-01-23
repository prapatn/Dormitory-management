<div class="card">
    <div class="card-header font-semibold text-xl text-gray-800 leading-tight"> ข้อมูลห้องพัก </div>
    <div class="card-body">
        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
        <div class="flex items-center justify-center mt-4">
            <div class="row justify-center">
                <div class="col">
                    <div class="form-group">
                        @if ($this->room==null)
                        <x-jet-label for="name" value="{{ __('อักษรนำเลขห้อง') }}" />
                        @else
                        <x-jet-label for="name" value="{{ __('เลขห้อง') }}" />
                        @endif
                        <input type="text" name="name" class="form-control" id="name" wire:model='name'
                            placeholder="เช่น A = A101,A102,..." autofocus>
                    </div>
                    <x-jet-input-error for="name" class="mt-2" />
                    <div class="form-group mt-4">
                        <x-jet-label for="floor" value="{{ __('ชั้น') }}" />
                        <input type="number" name="floor" class="form-control" id="floor" required autofocus
                            wire:model='floor' min="1">
                    </div>
                    <x-jet-input-error for="floor" class="mt-2" />
                    @if ($this->room==null)
                    <div class="form-group mt-4">
                        <x-jet-label for="num_start" value="{{ __('เลขห้องเริ่มต้น') }}" />
                        <input type="number" name="num_start" class="form-control" id="num_start" required autofocus
                            placeholder="เช่น 1" min="1" max="99" wire:model='num_start'>
                    </div>
                    <x-jet-input-error for="num_start" class="mt-2" />
                    <div class="form-group mt-4">
                        <x-jet-label for="num_end" value="{{ __('เลขห้องสิ้นสุด') }}" />
                        <input type="number" name="num_end" class="form-control" id="num_end" required autofocus
                            min="{{$this->num_start}}" placeholder="เช่น 10" max="99" wire:model='num_end'>
                    </div>
                    <x-jet-input-error for="num_end" class="mt-2" />
                    @endif
                    <div class="form-group mt-4">
                        <x-jet-label for="price" value="{{ __('ราคาเช่า/เดือน') }}" />
                        <input type="text" name="price" class="form-control" id="price" wire:model='price' required
                            autofocus min="1">
                    </div>
                    <x-jet-input-error for="price" class="mt-2" />
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
