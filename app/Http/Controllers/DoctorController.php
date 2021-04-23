<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $dateNow = $date->format('Y-m-d');

        $patients = Patient::whereHas('diseases', function ($q) {
            $q->where('diseases.id', Auth::user()->doctor->disease_id);
        })->paginate(5);

        $attendances = Attendance::where(
            [
                ['attendanceable_id', Auth::user()->doctor->id],
                ['attendanceable_type', 'App\Models\Doctor'],
            ]
        )->get();

        if (count($attendances) > 0) {
            for ($i = 0; $i < count($attendances); $i++) {
                if ($attendances[$i]->tanggal == $dateNow) {
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
        $tanggalLahir = explode('-', $doctor->tanggal_lahir);
        $doctor['thn'] = $tanggalLahir[0];
        $doctor['bln'] = $tanggalLahir[1];
        $doctor['tgl'] = $tanggalLahir[2];

        $spesialist = Disease::where('id', $doctor->disease_id)->first();
        return view('doctor.show', compact('doctor', 'spesialist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $tanggalLahir = explode('-', $doctor->tanggal_lahir);
        $doctor['thn'] = $tanggalLahir[0];
        $doctor['bln'] = $tanggalLahir[1];
        $doctor['tgl'] = $tanggalLahir[2];

        $diseases = Disease::orderBy('nama_penyakit')->get();
        return view('doctor.edit', compact('doctor', 'diseases'));
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
        $tanggalLahir = $request->thn
            . str_pad($request->bln, 2, 0, STR_PAD_LEFT)
            . str_pad($request->tgl, 2, 0, STR_PAD_LEFT);
        $request['tanggal_lahir'] = $tanggalLahir;

        $data = $request->validate(
            [
                'nid'              => 'required|numeric|min:8|unique:doctors,nid,' . $doctor->id,
                'nama'             => 'required|string|max:50',
                'email'            => 'required|email|unique:users,email,' . $doctor->user->id,
                'password'         => ($request->password == null ? 'sometimes' : 'confirmed'),
                'tanggal_lahir' => 'required|date|before:-10 years|after:-100 years',
                'alamat'           => 'required',
                'jenis_kelamin'    => 'required|in:L,P',
                'handphone'        => 'required|numeric',
                'photo'            => 'file|image|max:5000',
                'disease_id'       => 'required|exists:\App\Models\Disease,id'
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = $doctor->photo ?? 'default_profile.jpg';
        }

        $data['photo'] = $namaFile;

        User::where('id', $doctor->user->id)->first()->update(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => ($request->password == null ? $doctor->user->password : Hash::make($request->password))
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
