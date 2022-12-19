<div>
    {{-- Province --}}
    <div class="col-span-6 sm:col-span-4 mt-4">
        <x-jet-label for="province" value="{{ __('Province') }}" />
        <select id="province" class="form-control mt-1" name="province" :value="old('province')" required autofocus
            autocomplete="province" wire:model="province">
            <option value="">Select a Province</option>
            @foreach ($provinces as $item)
                <option value="{{ $item->id }}">{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>

    {{-- Amphure --}}
    <div class="col-span-6 sm:col-span-4 mt-4">
        <x-jet-label for="amphure" value="{{ __('Amphure') }}" />
        <select id="amphure" class="form-control mt-1" name="amphure" :value="old('amphure')" required
            autofocus autocomplete="amphure" wire:model="amphure">
            <option value="">Select a Amphure</option>
            @foreach ($amphures as $item)
                <option value="{{ $item->id }}">{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>

      {{-- District --}}
      <div class="col-span-6 sm:col-span-4 mt-4">
        <x-jet-label for="district" value="{{ __('District') }}" />
        <select id="district" class="form-control mt-1" name="district" :value="old('district')" required
            autofocus autocomplete="district" wire:model="district">
            <option value="">Select a District</option>
            @foreach ($districts as $item)
                <option value="{{ $item->id }}">{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>

</div>
