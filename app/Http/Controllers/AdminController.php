<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientCount = Patient::count();
        $nurseCount = Nurse::count();
        $doctorCount = Doctor::count();
        return view('admin.home', compact('patientCount', 'nurseCount', 'doctorCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $patients = Patient::paginate(10);
        // return view('admin.data-pasien', compact('patients'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function dataPasien()
    {
        $patients = Patient::orderBy('nama')->paginate(10);
        return view('admin.patient.data-pasien', compact('patients'));
    }

    public function showDataPasien(Patient $patient)
    {
        $tanggalLahir = explode('-', $patient->tanggal_lahir);
        $patient['thn'] = $tanggalLahir[0];
        $patient['bln'] = $tanggalLahir[1];
        $patient['tgl'] = $tanggalLahir[2];

        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesTaken = Disease::whereIn('id', $patient->diseases->pluck('id')->all())->get();
        $rooms = Room::withCount('patients')->orderBy('nomor_kamar')->get();

        $doctorSpesialists = Disease::where('doctor_id', $diseasesTaken->pluck('doctor_id')->all())->get();
        $spesialists = [];
        for ($i = 0; $i < count($doctorSpesialists); $i++) {
            if (in_array($doctorSpesialists[$i]->nama_penyakit, $diseasesTaken->pluck('nama_penyakit')->all())) {
                array_push($spesialists, $doctorSpesialists[$i]->nama_penyakit);
            }
            continue;
        }
        return view('admin.patient.show', compact('patient', 'diseases', 'diseasesTaken', 'spesialists', 'rooms'));
    }

    public function editDatapasien(Patient $patient)
    {
        $tanggalLahir = explode('-', $patient->tanggal_lahir);
        $patient['thn'] = $tanggalLahir[0];
        $patient['bln'] = $tanggalLahir[1];
        $patient['tgl'] = $tanggalLahir[2];
        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesPatient = Disease::whereIn('id', $patient->diseases->pluck('id')->all())->get();
        $diseasesTaken = $diseasesPatient->pluck('id')->toArray();
        return view('admin.patient.edit', compact('patient', 'diseases', 'diseasesTaken'));
    }

    public function destroyDataPasien(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admins.data.patient')->withSuccess("Pasien {$patient->nama} berhasil dihapus!");
    }

    public function dataPerawat()
    {
        $nurses = Nurse::paginate(5);
        return view('admin.nurse.data-perawat', compact('nurses'));
    }
}
