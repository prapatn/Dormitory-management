<div class="card">
    <div class="card-header font-semibold text-xl text-gray-800 leading-tight">ข้อมูลสัญญา</div>
    <div class="card-body">
        @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
        <div class="flex items-center justify-center mt-4">
            <div class="row justify-center">
                <h4 class="font-semibold">ข้อมูลผู้เช่า</h4>
                <div class="col-span-6 sm:col-span-4  mt-4">
                    <x-jet-label for="renter" value="{{ __('ผู้เช่า มี/ไม่มี บัญชีในระบบ') }}" />
                    <select id="renter" class="form-control text-s" autofocus name="renter" wire:model="renter">
                        <option value="">ไม่มี</option>
                        <option value="0">มี</option>

                    </select>
                </div>

                <div class="col-12">
                    @if ($this->renter == '')
                    <input type="text" name="user_id" value="{{null}}" hidden>
                    <div class="mt-4">
                        <x-jet-label for="name" value="{{ __('ชื่อ-นามสกุล') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus
                            autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="phone" value="{{ __('เบอร์โทรศัพท์') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" autofocus required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('อีเมล') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" autofocus
                            required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('รหัสผ่าน') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autofocus autocomplete="new-password" />
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('ยืนยันรหัสผ่าน') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-jet-input-error for="password_confirmation" class="mt-2" />
                    </div>

                    @elseif($this->renter=="0")

                    <div class="relative mt-4">
                        <x-jet-label for="search" value="{{ __('อีเมล/เบอร์โทรศัพท์') }}" />
                        <x-jet-input type='text' class="form-control block mt-1 w-full" wire:model="search" autofocus
                            required wire:keydown.escape="resetSearch" wire:keydown.tab="resetSearch" />
                        @if ($this->results)
                        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="resetSearch"></div>
                        <div class="relative">
                            <div class="absolute  w-full bg-white rounded-t-none shadow-lg list-group">
                                @foreach ($results as $row )
                                <option class="p-2 list-item hover:bg-gray-800 hover:text-white border rounded"
                                    wire:click="selectUser('{{$row->id}}')">
                                    {{$row->email ." ". $row->phone}}
                                </option>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    </div>
                    @if ($this->user)
                    <div class="  items-center justify-center">
                        <div class=" justify-center">
                            <div class="">
                                <div class="flex items-center justify-center">
                                    <div class="mt-4 items-center">
                                        <img src="{{empty(!$this->user->profile_photo_url) ? $this->user->profile_photo_url : asset($this->user->profile_photo_url) }} "
                                            width='200' height='200'>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <x-jet-label value="{{ __('ชื่อผู้เช่า') }}" />
                                    <x-jet-input class="form-control block mt-1 w-full"
                                        value='{{$this->user->name ." (".$this->user->email ." ". $this->user->phone .") "}}'
                                        disabled />
                                    <input type="text" class="hidden" value="{{$this->user->id}}" name="user_id"
                                        id="user_id">
                                    <x-jet-input-error for="user_id" class="mt-2" />

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endif

                    <h4 class="font-semibold mt-4">ข้อมูลสัญญาเช่า</h4>

                    <h5>ห้อง : {{ $this->room->name}}</h5>

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
                                            <img src="{{empty(!$photo) ? $photo->temporaryUrl() : asset($dbphoto) }} "
                                                width='200' height='200'>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class=" flex items-center justify-center">
                                    <div class="row justify-center">
                                        <div class="mt-2 items-center">
                                            <img src="{{asset('images/agreement.png')}}" alt="" width='200'
                                                height='200'>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <input type="file" name="photo" wire:model='photo' class="form-control mt-4">
                                <x-jet-input-error for="photo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="price_guarantee" value="{{ __('ค่าประกัน') }}" />
                        <x-jet-input id="price_guarantee" class="block mt-1 w-full" type="number" name="price_guarantee"
                            :value="old('price_guarantee')" required autofocus autocomplete="price_guarantee" />
                        <x-jet-input-error for="price_guarantee" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="start_date" value="{{ __('เข้าอยู่') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                            :value="old('start_date')" required />
                        <x-jet-input-error for="start_date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="end_date" value="{{ __('สิ้นสุด') }}" />
                        <x-jet-input id="end_date" class="block mt-1 w-full" type="date" name="end_date"
                            :value="old('end_date')" required />
                        <x-jet-input-error for="end_date" class="mt-2" />
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
