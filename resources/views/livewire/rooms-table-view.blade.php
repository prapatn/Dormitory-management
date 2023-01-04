<div>

    <div class="col-3 mb-2">
        <input wire:model="search" type="search" placeholder="ค้นหาด้วยหมายเลขห้อง" class="form-control">
    </div>

    <table class="table table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ห้อง</th>
                <th>ชั้น</th>
                <th>รายค่าเช่า/เดือน</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
        </thead>
        @if (count($rooms)>0)
        <tbody>
            @foreach ($rooms as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->floor }}</td>
                <td>{{ $row->price }}</td>
                <td>{{" ว่าง " }}</td>
                <td style="text-align:right;">
                    <a href="{{ url('dormitories/show/' . $row->id) }}" class="btn btn-primary">รายละเอียด</a>
                    <a href="{{ url('dormitories/edit/' . $row->id) }}" class="btn btn-warning">แก้ไข</a>
                    <a href="{{ route('room.delete',['id'=>$row->id]) }}" class="btn btn-danger"
                        onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')">ลบ</a>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <p class="" style="color: red">
            ค้นหาไม่พบ </p>
        @endif

    </table>
    {{-- Tab page --}}
    <div class="mt-4">
        {{ $rooms->links() }}
    </div>




</div>
