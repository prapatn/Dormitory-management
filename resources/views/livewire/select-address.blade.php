<div>

    {{-- Address detail --}}
    <div class="">
        <x-jet-label for="address" value="{{ __('รายละเอียดที่อยู่ (บ้านเลขที่ หมู่ ถนน ซอย)') }}" />
        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required
            autofocus autocomplete="address" />
    </div>

    {{-- Province --}}
    <div class="col-span-6 sm:col-span-4 mt-4">
        <x-jet-label for="province" value="{{ __('จังหวัด') }}" />
        <select id="province" class="form-control mt-1" name="province" :value="$province" required
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
        <select id="amphure" class="form-control mt-1 text-s" name="amphure" :value="old('amphure')" required
            autocomplete="amphure" wire:model="amphure">
            <option value=""></option>
            @foreach ($amphures as $item)
            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>

    {{-- District --}}
    <div class="col-span-6 sm:col-span-4 mt-4">
        <x-jet-label for="district" value="{{ __('ตำบล/แขวง') }}" />
        <select id="district" class="form-control mt-1" name="district" :value="old('district')" required
            autocomplete="district" wire:model="district">
            <option value=""></option>
            @foreach ($districts as $item)
            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>
</div>
