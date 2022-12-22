{{-- Form --}}
<div class="col-md-12">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">แก้ไขข้อมูล</div>
            <div class="card-body">

                @csrf {{-- ป้องกันการ Hack ด้วย การป้อน Script --}}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <img src="" alt="" width="300px" height="300px">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="old_image" value="">
                            <label for="image">รูป</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        @error('image')
                        <div class="my-2">
                            <span class="text-danger"></span>
                        </div>
                        @enderror
                        <br>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="name">ชื่อ</label>
                            <input type="text" name="name" class="form-control" id="name" value="">
                        </div>
                        @error('name')
                        <div class="my-2">
                            <span class="text-danger"></span>
                        </div>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="phone_number">เบอร์โทรศัพท์</label>
                            <input type="number" name="phone_number" class="form-control" id="phone_number" value="">
                        </div>
                        @error('phone_number')
                        <div class="my-2">
                            <span class="text-danger"></span>
                        </div>
                        @enderror
                        <br>
                    </div>
                </div>
            </div>
            <div class="container mb-4 mr-2">
                <div class="flex items-center justify-end">
                    <a href="{{ route('dorm.create') }}"
                        class="btn btn-success inline-flex items-center px-4 py-2 rounded-md font-semibold"
                        type="button">
                        {{ __('บันทึกข้อมูล') }}</a>
                </div>
            </div>
        </div>
    </form>
</div>
