<?php

namespace App\Http\Controllers;

use App\Models\Dormitory;
use App\Http\Requests\StoreDormitoryRequest;
use App\Http\Requests\UpdateDormitoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

class DormitoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dormitories = Dormitory::where('user_id', Auth::user()->id)->paginate(3);
        return view('owner.dormitories.index', compact('dormitories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.dormitories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDormitoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDormitoryRequest $request)
    {
        $validateData = $request->validated();

        $dormitory = new  Dormitory();

        $image = $request->file('photo');
        if (isset($image)) {
            $dormitory->image = app('App\Http\Controllers\AuthController')->saveImage($image, "image/dorm/");
        }

        $dormitory->user_id = Auth::user()->id;
        $dormitory->name = $validateData['name'];
        $dormitory->phone = $validateData['phone'];
        $dormitory->address = $validateData['address'];
        $dormitory->province_id = $validateData['province'];
        $dormitory->amphure_id = $validateData['amphure'];
        $dormitory->district_id = $validateData['district'];
        $dormitory->electricity_per_unit = $validateData['electricity_per_unit'];
        $dormitory->water_per_unit = $validateData['water_per_unit'];
        $dormitory->water_min_unit = $validateData['water_min_unit'];
        $dormitory->water_pay_min = $validateData['water_pay_min'];

        $dormitory->save();
        session()->flash('Success', 'บันทึกข้อมูลสำเร็จ');
        return redirect()->route('dorm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function show(Dormitory $dormitory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('owner.dormitories.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDormitoryRequest  $request
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDormitoryRequest $request, Dormitory $dormitory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dormitory $dormitory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dormitory  $dormitory
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $dormitory = Dormitory::where([
                'id' => $id,
                'user_id' => Auth::user()->id,
            ])->first();
            if ($dormitory->image) {
                unlink($dormitory->image);
            }
            $dormitory->delete();
            session()->flash('Success', 'ลบข้อมูลสำเร็จ');
            return redirect()->route('dorm');
        } catch (\Throwable $th) {
            session()->flash('Fail', 'ผิดพลาดกรุณาดำเนินการอีกครั้ง');
            return redirect()->route('dorm');
        }
    }
}
