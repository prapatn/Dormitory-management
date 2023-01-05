<?php

namespace App\Http\Controllers;

use App\Models\room;
use App\Http\Requests\StoreroomRequest;
use App\Http\Requests\UpdateroomRequest;
use App\Models\Dormitory;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Output\ConsoleOutput;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            $dormitory = Dormitory::where([
                'id' => $id,
                'user_id' => Auth::user()->id,
            ])->first();
            return view('owner.room.create', compact('dormitory'));
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreroomRequest $request)
    {
        $str_success = null;
        $str_fail = null;
        $validateData = $request->validated();
        $nameTitle = $validateData['name'] ? $validateData['name'] : "";
        for ($i = $validateData['num_start']; $i <=  $validateData['num_end']; $i++) {
            // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            // $out->writeln($name);
            if ($i < 10) {
                $name =  $nameTitle . "" . $validateData['floor'] . "0" . $i;
            } else {
                $name = $nameTitle . "" . $validateData['floor'] . "" . $i;
            }
            $room = Room::where(['name' => $name, 'dorm_id' => $request['dorm_id']])->first();
            if ($room == null) {
                $room = new Room();
                $room->name = $name;
                $room->dorm_id =  $request['dorm_id'];
                $room->floor = $validateData['floor'];
                $room->price = $validateData['price'];
                $room->save();
                $str_success = $str_success . " ห้อง " . $name . " บันทึกข้อมูลสำเร็จ" . "\r\n";
            } else {
                $str_fail = $str_fail . " ห้อง " . $name . " มีข้อมูลในระบบแล้ว" . "\r\n";
            }
        }
        session()->flash('Success', $str_success);
        session()->flash('Fail', $str_fail);
        return redirect('dormitories/show/' . $request['dorm_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $room = Room::where([
                'id' => $id,
            ])->first();
            $dormitory = Dormitory::where([
                'id' =>  $room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();

            if (!$dormitory) {
                return  abort(403);
            } else {
                return view('owner.room.edit', compact('room'));
            }
        } catch (\Throwable $th) {
            return  abort(403);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateroomRequest  $request
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateroomRequest $request)
    {
        $validateData = $request->validated();
        Room::find($request['id'])->update([
            'name' => $validateData['name'],
            'floor' =>  $validateData['floor'],
            'price' =>  $validateData['price'],
        ]);
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('dorm.show', ['id' => $request->dorm_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(room $room)
    {
        //
    }

    public function delete($id)
    {
        try {
            $room = Room::where([
                'id' => $id,
            ])->first();
            $dorm = Dormitory::where([
                'id' =>  $room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();

            if ($dorm) {
                $room->delete();
                session()->flash('Success', 'ลบข้อมูลสำเร็จ');
                return  redirect()->back();
            } else {
                session()->flash('Fail', 'ผิดพลาดกรุณาดำเนินการอีกครั้ง');
                return  redirect()->back();
            }
        } catch (\Throwable $th) {
            session()->flash('Fail', 'ผิดพลาดกรุณาดำเนินการอีกครั้ง');
            return  redirect()->back();
        }
    }
}
