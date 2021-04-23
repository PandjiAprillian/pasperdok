<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NurseController extends Controller
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

        $patients = Patient::where('room_id', Auth::user()->nurse->room_id)->get();

        $attendances = Attendance::where(
            [
                ['attendanceable_id', Auth::user()->nurse->id],
                ['attendanceable_type', 'App\Models\Nurse']
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

        return view('nurse.home', compact('patients', 'attendanceDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::orderBy('nomor_kamar')->get();
        return view('admin.nurse.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggalLahir = $request->thn
            . str_pad($request->bln, 2, 0, STR_PAD_LEFT)
            . str_pad($request->tgl, 2, 0, STR_PAD_LEFT);
        $request['tanggal_lahir'] = $tanggalLahir;

        $request->validate(
            [
            'nip'           => 'required|integer|min:8|unique:nurses',
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|confirmed',
                'alamat'        => 'required',
                'tanggal_lahir' => 'required|date|before:-10 years|after:-100 years',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|numeric',
                'photo'         => 'file|image|max:5000',
                'room_id'       => 'exists:\App\Models\Room,id',
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = 'default_profile.jpg';
        }

        $userAsNurse = User::create(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        $userAsNurse->nurse()->create(
            [
                'nip'           => $request->nip,
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'handphone'     => $request->handphone,
                'photo'         => $namaFile,
                'keluhan'       => $request->keluhan,
                'room_id'       => $request->room_id
            ]
        );

        $userAsNurse->assignRole('nurse');
        $nurseId = Nurse::where('nip', $request->nip)->first();
        return redirect()->route('nurses.show', ['nurse' => $nurseId->id])->withSuccess("Data perawat {$request->nama} berhasil di daftarkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function show(Nurse $nurse)
    {
        $tanggalLahir = explode('-', $nurse->tanggal_lahir);
        $nurse['thn'] = $tanggalLahir[0];
        $nurse['bln'] = $tanggalLahir[1];
        $nurse['tgl'] = $tanggalLahir[2];

        return view('nurse.show', compact('nurse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function edit(Nurse $nurse)
    {
        $tanggalLahir = explode('-', $nurse->tanggal_lahir);
        $nurse['thn'] = $tanggalLahir[0];
        $nurse['bln'] = $tanggalLahir[1];
        $nurse['tgl'] = $tanggalLahir[2];

        if (Auth::user()->hasRole('admin')) {
            $rooms = Room::orderBy('nomor_kamar')->get();
        } else {
            $rooms = [];
        }

        return view('nurse.edit', compact('nurse', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nurse $nurse)
    {
        $tanggalLahir = $request->thn
            . str_pad($request->bln, 2, 0, STR_PAD_LEFT)
            . str_pad($request->tgl, 2, 0, STR_PAD_LEFT);
        $request['tanggal_lahir'] = $tanggalLahir;

        $data = $request->validate(
            [
                'nip'           => 'required|integer|min:8|unique:nurses,nip,' . $nurse->id,
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users,email,' . $nurse->user->id,
                'password'      => ($request->password == null ? 'sometimes' : 'confirmed'),
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|numeric',
                'photo'         => 'file|image|max:5000',
                'room_id'       => 'exists:\App\Models\Room,id',
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = $nurse->photo ?? 'default_profile.jpg';
        }

        $data['photo'] = $namaFile;


        if (Auth::user()->hasRole('nurse')) {
            User::where('id', Auth::user()->id)->first()->update(
                [
                    'email' => $request->email,
                    'password' => ($request->password == null ? $nurse->user->password : Hash::make($request->password))
                ]
            );
        } else {
            User::where('id', $nurse->user->id)->first()->update(
                [
                    'email'    => $request->email,
                    'password' => ($request->password == null ? $nurse->user->password : Hash::make($request->password))
                ]
            );
        };

        $nurse->update($data);

        return redirect()->route('nurses.show', ['nurse' => $nurse->id])->with('success', 'Update data berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nurse $nurse)
    {
        User::where('id', $nurse->user->id)->delete();
        return redirect()->route('admins.data.nurse')->withSuccess("Data perawat {$nurse->nama} berhasil dihapus!");
    }

    public function rekapJadwal(Nurse $nurse)
    {
        $attendances = Attendance::where(
            [
                ['attendanceable_id', $nurse->id],
                ['attendanceable_type', 'App\Models\Nurse'],
            ]
        )->paginate(5);
        return view('nurse.rekap-jadwal', compact('nurse', 'attendances'));
    }
}
