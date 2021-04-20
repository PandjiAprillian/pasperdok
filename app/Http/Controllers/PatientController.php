<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PatientController extends Controller
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
    public function create()
    {
        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesTaken = (auth()->check()) ? auth()->user()->patient->diseases->pluck('id')->all() : [];
        return view('patient.register', compact('diseases', 'diseasesTaken'));
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

        $data = $request->validate(
            [
                'nik'           => 'required|integer|min:8|unique:patients',
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|confirmed',
                'tanggal_lahir' => 'required|date|before:-10 years|after:-100 years',
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|numeric',
                'photo'         => 'file|image|max:5000',
                'diseases.*'    => 'distinct|in:' . implode(',', \App\Models\Disease::pluck('id')->all()),
                'keluhan'       => 'required'
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = 'default_profile.jpg';
        }

        $userAsPatient = User::create(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        $userAsPatient->patient()->create(
            [
                'nik'           => $request->nik,
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'handphone'     => $request->handphone,
                'photo'         => $namaFile,
                'keluhan'       => $request->keluhan,
            ]
        );

        $userAsPatient->patient->diseases()->sync($data['diseases'] ?? []);

        $userAsPatient->assignRole('patient');
        Auth::login($userAsPatient);
        toast("Registrasi Berhasil!", 'success');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $tanggalLahir = explode('-', $patient->tanggal_lahir);
        $patient['thn'] = $tanggalLahir[0];
        $patient['bln'] = $tanggalLahir[1];
        $patient['tgl'] = $tanggalLahir[2];

        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesTaken = Disease::whereIn('id', $patient->diseases->pluck('id')->all())->get();
        $rooms = Room::withCount('patients')->orderBy('nomor_kamar')->get();

        if (Auth::user()->hasRole('doctor')) {
            $doctorSpesialists = Disease::where('doctor_id', $diseasesTaken->pluck('doctor_id')->all())->get();
            $spesialists = [];
            for ($i=0; $i < count($doctorSpesialists); $i++) {
                if (in_array($doctorSpesialists[$i]->nama_penyakit, $diseasesTaken->pluck('nama_penyakit')->all())) {
                    array_push($spesialists, $doctorSpesialists[$i]->nama_penyakit);
                }
                continue;
            }
            return view('patient.show', compact('patient', 'diseases', 'diseasesTaken', 'spesialists', 'rooms'));
        }

        return view('patient.show', compact('patient', 'diseases', 'diseasesTaken', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $tanggalLahir = explode('-', $patient->tanggal_lahir);
        $patient['thn'] = $tanggalLahir[0];
        $patient['bln'] = $tanggalLahir[1];
        $patient['tgl'] = $tanggalLahir[2];
        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesPatient = Disease::whereIn('id', $patient->diseases->pluck('id')->all())->get();
        $diseasesTaken = $diseasesPatient->pluck('id')->toArray();
        return view('patient.edit', compact('patient', 'diseases', 'diseasesTaken'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $tanggalLahir = $request->thn
            . str_pad($request->bln, 2, 0, STR_PAD_LEFT)
            . str_pad($request->tgl, 2, 0, STR_PAD_LEFT);
        $request['tanggal_lahir'] = $tanggalLahir;

        $data = $request->validate(
            [
                'nik'           => 'required|integer|min:8|unique:patients,nik,' . $patient->id,
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users,email,' . $patient->user->id,
                'tanggal_lahir' => 'required|date|before:-10 years|after:-100 years',
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|numeric',
                'photo'         => 'file|image|max:5000',
                'diseases.*'    => 'distinct|in:' . implode(',', \App\Models\Disease::pluck('id')->all()),
                'keluhan'       => 'required'
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = $patient->photo ?? 'default_profile.jpg';
        }

        User::where('id', $patient->user->id)->first()->update(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
            ]
        );

        $userAsPatient = User::find($patient->user->id);

        $userAsPatient->patient()->update(
            [
                'nik'           => $request->nik,
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'handphone'     => $request->handphone,
                'photo'         => $namaFile,
                'keluhan'       => $request->keluhan,
            ]
        );

        $userAsPatient->patient->diseases()->sync($data['diseases'] ?? []);
        Alert::success('Berhasil!', "Update data untuk pasien {$patient->nama} berhasil!");
        return redirect()->route('patients.show', ['patient' => $patient->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }

    public function perawatan(Request $request, Patient $patient)
    {
        $request->validate(
            [
                'rawat_inap' => 'in:1,2',
                // 'room_id'    => 'exists:rooms,\App\Models\Room,id'
            ]
        );

        $rooms = Room::withCount('patients')->orderBy('nomor_kamar')->get();
        dd($rooms->toArray());
        for ($i = 0; $i < count(Room::all()); $i++) {
            if ($request->room_id == $rooms[$i]) {
                if ($rooms[$i]->patients_count >= 2) {
                    return back()->with('warning', "Kamar dengan nomor {$rooms[$i]->nomor_kamar} sudah terisi penuh!");
                }
            }
        }

        if ($request->rawat_inap == 1) {
            Patient::where('id', $patient->id)->update(
                [
                    'rawat_inap' => $request->rawat_inap,
                    'room_id' => $request->room_id
                ]
            );
        } else {
            Patient::where('id', $patient->id)->update(
                [
                    'rawat_inap' => $request->rawat_inap,
                ]
            );
        }

        return redirect('/doctors')->with('success', "Data rawat berhasil disimpan!");
    }
}
