@if (count($bills)>0)
<div class="table-wrapper">
    <div class="col-3 mb-2">
        <input wire:model="search" type="search" placeholder="ค้นหาด้วยสถานะ" class="form-control">
    </div>
    <div class="md-card-content" style="overflow-x: auto;">
        <table class="table table-striped mt-4" style="overflow-x: auto;">
            @if (count($results)>0)
            <thead class="table-dark">
                <tr>
                    <th>สถานะ</th>
                    <th>กำหนดชำระ</th>
                    <th>ค่าเช่าห้อง</th>
                    <th>ค่าไฟ (หน่วย x ราคา)</th>
                    <th>ค่าน้ำ (หน่วย x ราคา)</th>
                    <th>ค่าอื่นๆ</th>
                    <th>รวม (บาท)</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($results as $row)
                <tr>
                    <td>{{ $row->status }}</td>
                    <td>{{ date('d/m/Y', strtotime($row->pay_last_date))}}</td>
                    <td>{{ $row->agreement->room->price }}</td>
                    <td>{{ $row->calElectricityText() }}</td>
                    <td>{{ $row->calWaterText() }}</td>
                    <td>{{ $row->pay_other }}</td>
                    <td>{{ $row->calAll() }}</td>
                    <td style="text-align:right;">
                        <a href="{{ route('bill.show', ['id'=>$row->id]) }}" class="btn btn-primary">รายละเอียด</a>
                        @if($row->status == "รอจ่าย")
                        <a href="{{ route('bill.edit', ['id'=>$row->id]) }}" class="btn btn-warning">แก้ไข</a>
                        <a href="{{ route('bill.delete', ['id'=>$row->id]) }}" class="btn btn-danger"
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

</div>
@endif
