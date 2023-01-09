<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Http\Requests\StoreAgreementRequest;
use App\Http\Requests\UpdateAgreementRequest;
use App\Models\Dormitory;
use App\Models\Room;
use App\Models\User;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Agreement $agreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgreementRequest  $request
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgreementRequest $request, Agreement $agreement)
    {
        //
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
}
