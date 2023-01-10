<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Http\Requests\StoreAgreementRequest;
use App\Http\Requests\UpdateAgreementRequest;
use App\Models\Dormitory;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgreementController extends Controller
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
        $room = Room::where([
            'id' => $id,
        ])->first();
        $dormitory = Dormitory::where([
            'id' =>  $room->dorm_id,
            'user_id' => Auth::user()->id,
        ])->first();

        if (!$dormitory) {
            abort(404);
        }
        return view('owner.agreement.create', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgreementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgreementRequest $request)
    {
        $validateData = $request->validated();
        $agreement = new  Agreement();

        //New Renter OR Renter have acc
        if (!$validateData['user_id']) {
            $user =  User::create([
                'name' => $validateData['name'],
                'role'  => 'renter',
                'phone'     => $validateData['phone'],
                'email' => $validateData['email'],
                'password' => Hash::make($validateData['password']),
            ]);
            $agreement->user_id = $user->id;
        } else {
            $agreement->user_id = $validateData['user_id'];
        }

        $image = $request->file('photo');
        if (isset($image)) {
            $agreement->image = app('App\Http\Controllers\AuthController')->saveImage($image, "image/agreement/");
        }

        $agreement->status = "รอยืนยัน";
        $agreement->room_id = $validateData['room_id'];
        $agreement->price_guarantee = $validateData['price_guarantee'];
        $agreement->start_date = $validateData['start_date'];
        $agreement->end_date = $validateData['end_date'];
        $agreement->save();
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('room.show', ['id' => $validateData['room_id'],]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::where([
            'id' => $id,
        ])->first();
        $dormitory = Dormitory::where([
            'id' =>  $room->dorm_id,
            'user_id' => Auth::user()->id,
        ])->first();
        if (!$dormitory) {
            abort(404);
        }
        $agreements = Agreement::where(['room_id' => $id])->get();
        $agreement = app('App\Http\Controllers\RoomController')->findAgreementNow($agreements);
        return view('owner.agreement.show', compact('room', 'agreement'));
    }

    public function notification_show()
    {
        $agreements = Agreement::where(['user_id' => Auth::user()->id])->latest()->paginate(10);
        return view('renter.notification.index', compact('agreements'));
    }

    public function agreement_change_status($id, $status)
    {
        $agreement = Agreement::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($agreement) {
            $agreement->status = $status;
            $agreement->save();
        } else {
            abort(404);
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $agreement = Agreement::where([
                'id' => $id,
            ])->first();
            $room = Room::where([
                'id' => $agreement->room_id,
            ])->first();
            $dormitory = Dormitory::where([
                'id' =>  $room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();

            if (!$dormitory) {
                abort(404);
            } else {
                return view('owner.agreement.edit', compact('agreement'));
            }
        } catch (\Throwable $th) {
            return  abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgreementRequest  $request
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgreementRequest $request)
    {
        $validateData = $request->validated();
        $agreement = Agreement::find($validateData['id']);
        $image = $request->file('photo');
        if (isset($image)) {
            //ลบภาพเก่า
            $old_img = $agreement->image;
            if ($old_img) {
                unlink($old_img);
            }
            $agreement->image = app('App\Http\Controllers\AuthController')->saveImage($image, "image/dorm/");
        }
        $agreement->price_guarantee = $validateData['price_guarantee'];
        $agreement->start_date = $validateData['start_date'];
        $agreement->end_date = $validateData['end_date'];
        $agreement->updated_at = Carbon::now('GMT+7');

        $agreement->save();
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('agreement.show', ['id' => $agreement->room_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agreement $agreement)
    {
        //
    }

    public function delete($id)
    {
        try {
            $agreement = Agreement::where([
                'id' => $id,
            ])->first();
            $room = Room::where([
                'id' => $agreement->room_id,
            ])->first();
            $dormitory = Dormitory::where([
                'id' =>  $room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();
            if (!$dormitory) {
                abort(404);
            } else {
                $agreement->delete();
                session()->flash('Success', 'ลบข้อมูลสำเร็จ');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return  abort(403);
        }
    }
}
