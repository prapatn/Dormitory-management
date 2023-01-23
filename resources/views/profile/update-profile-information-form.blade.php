<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('รูปโปรไฟล์') }}" />
            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="!photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>

            @if ($this->user->profile_photo_path)
            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                {{ __('Remove Photo') }}
            </x-jet-secondary-button>
            @endif

            <x-jet-input-error for="photo" class="mt-2" />
        </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('ชื่อ-นามสกุล') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autofocus
                autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('รายละเอียดที่อยู่ (บ้านเลขที่ หมู่ ถนน ซอย)') }}" />
            <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" required
                autofocus autocomplete="address" />
            <x-jet-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">

            {{-- Province --}}
            <div class="col-span-6 sm:col-span-4 ">
                <x-jet-label for="province" value="{{ __('จังหวัด') }}" />
                <select id="province" class="form-control mt-1" name="province" required autofocus
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
                <select id="district" class="form-control mt-1" name="district" :value="old('district')"
                    autocomplete="district" wire:model="district">
                    <option value=""></option>
                    @foreach ($districts as $item)
                    <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone" value="{{ __('เบอร์โทรศัพท์') }}" />
            <x-jet-input id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" required autofocus
                autocomplete="phone" />
            <x-jet-input-error for="phone" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('อีเมล') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autofocus />
            <x-jet-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !
            $this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
            <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
