<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
        $diseasesTaken = (auth()->check()) ? auth()->user()->patient->diseases->pluck('id')->all() : [] ;
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

        $request->validate(
            [
                'nik'           => 'required|integer|min:8',
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|confirmed',
                'tanggal_lahir' => 'required|date|before:-10 years|after:-100 years',
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|max:13',
                'photo'         => 'required|file|image|max:5000',
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

        $patient = User::create(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        $patient->patient()->create(
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

        $patient->assignRole('patient');
        Auth::login($patient);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
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
        //
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
}
