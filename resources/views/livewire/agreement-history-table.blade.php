@if (count($agreements)>0)
<div>
    <div class="col-3 mb-2">
        <input wire:model="search" type="search" placeholder="ค้นหาด้วยชื่อผู้เช่า" class="form-control">
    </div>
    <table class="table table-striped mt-4">
        @if (count($results)>0)
        <thead class="table-dark">
            <tr>
                <th>ผู้เช่า</th>
                <th>วันเริ่มสัญญา</th>
                <th>วันสิ้นสุดสัญญา</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($results as $row)
            <tr>
                <td>{{ $row->user->name }} ( {{ $row->user->email }} {{ $row->user->phone }} )</td>
                <td>{{date('d/m/Y', strtotime($row->start_date))}}</td>
                <td>{{date('d/m/Y', strtotime($row->end_date)) }}</td>
                <td>{{$row->status=="ยอมรับ"?$this->checkDateBetween($row->start_date,$row->end_date):$row->status }}
                </td>
                <td style="text-align:right;">
                    <a href="#" class="btn btn-primary">รายละเอียด</a>
                    @if ($row->status=="รอยืนยัน")
                    <a href="{{ route('agreement.edit', ['id'=>$row->id]) }}" class="btn btn-warning">แก้ไข</a>
                    <a href="{{ route('agreement.delete', ['id'=>$row->id]) }}" class="btn btn-danger"
                        onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')">ลบ</a>
                    @endif
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
        {{ $results->links() }}
    </div>
</div>
@else
<div class="flex items-center justify-center">
    <h5 class="font-semibold " style="color: red">
        ห้องนี้ยังไม่มีข้อมูล</h5>
</div>

@endif
