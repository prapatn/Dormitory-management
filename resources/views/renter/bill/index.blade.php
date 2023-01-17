<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'จัดการค่าเช่าห้อง'}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                {{-- Table --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-xl font-semibold">รายการบิลค่าเช่า</div>
                        <div class="card-body">
                            <div class="py-6">
                                <div class="container">
                                    <div class="row">
                                        @livewire('bill-table',)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
