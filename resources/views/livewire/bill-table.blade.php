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
                    <th>หอพัก-ห้อง</th>
                    <th>กำหนดชำระ</th>
                    <th>ค่าเช่ารวม (บาท)</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($results as $row)
                <tr>
                    <td>{{ $row->status }}</td>
                    <td>{{$row->agreement->room->dormitory->name ." - " .$row->agreement->room->name }}</td>
                    <td>{{ date('d/m/Y', strtotime($row->pay_last_date))}}</td>
                    <td>{{ $row->calAll() }}</td>
                    <td style="text-align:right;">
                        @if($row->status == "รอจ่าย")
                        @if ($this->user->role=="owner")
                        <a href="{{ route('bill.show', ['id'=>$row->id]) }}" class="btn btn-primary">รายละเอียด</a>
                        <a href="{{ route('bill.edit', ['id'=>$row->id]) }}" class="btn btn-warning">แก้ไข</a>
                        <a href="{{ route('bill.delete', ['id'=>$row->id]) }}" class="btn btn-danger"
                            onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่')">ลบ</a>
                        @elseif ($this->user->role == 'renter')
                        <a href="{{ route('payment.create', ['id'=>$row->id]) }}"
                            class="btn btn-success">จ่ายค่าเช่า</a>
                        @endif
                        @else
                        <a href="{{ route('payment.create', ['id'=>$row->id]) }}" class="btn btn-primary">รายละเอียด</a>
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
