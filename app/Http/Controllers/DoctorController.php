<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::whereHas('diseases', function ($query) {
            $query->where('doctor_id', Auth::user()->doctor->id);
        })->paginate(5);

        $attendances = Attendance::where('attendanceable_id', Auth::user()->doctor->id)->get();
        if (count($attendances) > 0) {
            for ($i = 0; $i < count($attendances); $i++) {
                if (($attendances[$i]->tanggal == date('Y-m-d', time())) && ($attendances[$i]->attendanceable_type == 'App\Models\Doctor')) {
                    $attendanceDate = $attendances[$i]->tanggal;
                } else {
                    $attendanceDate = null;
                }
            }
        } else {
            $attendanceDate = null;
        }

        return view('doctor.home', compact('patients', 'attendanceDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate(
            [
                'nid'           => 'required|integer|min:8|unique:doctors,nid,' . $doctor->id,
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users,email,' . $doctor->user->id,
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|numeric',
                'photo'         => 'file|image|max:5000',
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = $doctor->photo ?? 'default_profile.jpg';
        }

        $data['photo'] = $namaFile;

        User::where('id', Auth::user()->id)->first()->update(
            [
                'email' => $request->email
            ]
        );

        $doctor->update($data);
        return redirect()->route('doctors.show', ['doctor' => $doctor->id])->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    public function rekapJadwal(Doctor $doctor)
    {
        $attendances = Attendance::where(
            [
                ['attendanceable_id', $doctor->id],
                ['attendanceable_type', 'App\Models\Doctor'],
            ]
        )->paginate(5);
        return view('doctor.rekap-jadwal', compact('doctor', 'attendances'));
    }
}
