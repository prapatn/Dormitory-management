<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Agreement;
use App\Models\Dormitory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('renter.bill.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $agreement = Agreement::where([
            'id' =>  $id,
        ])->first();
        $dormitory = Dormitory::where([
            'id' =>  $agreement->room->dorm_id,
            'user_id' => Auth::user()->id,
        ])->first();
        if (!$dormitory) {
            abort(404);
        }
        return view('owner.bill.create', compact('agreement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillRequest $request)
    {
        $validateData = $request->validated();
        $bill = new Bill([
            "agreement_id" => $validateData['agreement_id'],
            "status" => "รอจ่าย",
            "pay_last_date" => $validateData['pay_last_date'],
            "electricity_unit" => $validateData['electricity_unit'],
            "water_unit" => $validateData['water_unit'],
            "electricity_unit_last" => $validateData['electricity_unit_last'],
            "water_unit_last" => $validateData['water_unit_last'],
            "pay_other" => $validateData['pay_other'],
        ]);
        $image = $request->file('photo');
        if (isset($image)) {
            $bill->image = app('App\Http\Controllers\AuthController')->saveImage($image, "image/bill/");
        }
        $bill->save();
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('room.show', ['id' => $validateData['room_id'],]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        try {
            $bill = Bill::where([
                'id' => $id,
            ])->first();

            if ($user->role == 'owner') {
                $dormitory = Dormitory::where([
                    'id' =>  $bill->agreement->room->dorm_id,
                    'user_id' => $user->id,
                ])->first();
                if (!$dormitory) {
                    abort(404);
                }
            }
            if ($user->role == 'renter') {
                if ($user->id != $bill->agreement->user_id) {
                    abort(404);
                }
            }
            return view('owner.bill.show', compact('bill', 'user'));
        } catch (\Throwable $th) {
            return  abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $bill = Bill::where([
                'id' => $id,
            ])->first();

            $dormitory = Dormitory::where([
                'id' =>  $bill->agreement->room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();
            if (!$dormitory) {
                abort(404);
            } else {
                return view('owner.bill.edit', compact('bill'));
            }
        } catch (\Throwable $th) {
            return  abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillRequest  $request
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillRequest $request)
    {
        $validateData = $request->validated();
        $bill = Bill::find($validateData['bill_id']);
        $image = $request->file('photo');
        if (isset($image)) {
            //ลบภาพเก่า
            $old_img = $bill->image;
            if ($old_img) {
                unlink($old_img);
            }
            $bill->image = app('App\Http\Controllers\AuthController')->saveImage($image, "image/dorm/");
        }
        $bill->electricity_unit_last = $validateData['electricity_unit_last'];
        $bill->electricity_unit = $validateData['electricity_unit'];
        $bill->water_unit_last = $validateData['water_unit_last'];
        $bill->water_unit = $validateData['water_unit'];
        $bill->pay_other = $validateData['pay_other'];
        $bill->pay_last_date = $validateData['pay_last_date'];

        $bill->save();
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('room.show', ['id' => $bill->agreement->room->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(bill $bill)
    {
        //
    }

    public function delete($id)
    {
        try {
            $bill = Bill::where([
                'id' => $id,
            ])->first();
            $dormitory = Dormitory::where([
                'id' =>  $bill->agreement->room->dorm_id,
                'user_id' => Auth::user()->id,
            ])->first();
            if (!$dormitory) {
                abort(404);
            } else {
                $bill->delete();
                session()->flash('Success', 'ลบข้อมูลสำเร็จ');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return  abort(403);
        }
    }
}
