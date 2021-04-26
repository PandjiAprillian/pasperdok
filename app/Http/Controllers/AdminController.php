<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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
        $diseasesCount = Disease::count();
        $roomsCount = Room::count();
        return view('admin.home', compact('patientCount', 'nurseCount', 'doctorCount', 'diseasesCount', 'roomsCount'));
    }

    public function dataAdmin()
    {
        $admins = Admin::orderBy('nama')->paginate(5);
        return view('admin.data-admin', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users',
                'password'      => 'required|confirmed',
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
            $namaFile = 'default_profile.jpg';
        }

        $userAsAdmin = User::create(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]
        );

        $userAsAdmin->admin()->create(
            [
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'handphone'     => $request->handphone,
                'photo'         => $namaFile,
            ]
        );

        $userAsAdmin->assignRole('admin');
        $adminId = Admin::where('user_id', $userAsAdmin->id)->first();
        return redirect()->route('admins.show', ['admin' => $adminId->id])->withSuccess("Admin {$adminId->nama} berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
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
        $request->validate(
            [
                'nama'          => 'required|min:5|max:50',
                'email'         => 'required|email|unique:users,email,' . $admin->user->id,
                'password'      => ($request->password == null ? 'sometimes' : 'confirmed'),
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
            $namaFile = $admin->photo ?? 'default_profile.jpg';
        }

        User::where('id', $admin->user->id)->first()->update(
            [
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => ($request->password == null ? $admin->user->password : Hash::make($request->password)),
            ]
        );

        $admin->update(
            [
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'handphone'     => $request->handphone,
                'photo'         => $namaFile
            ]
        );

        Alert::success("Berhasil!", "Data admin {$request->nama} berhasil di update!");
        return redirect()->route('admins.show', ['admin' => $admin->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        User::where('id', $admin->user->id)->first()->delete();
        Auth::logout();
        return redirect('/')->withSuccess("Data admin {$admin->nama} berhasil dihapus!");
    }

    //? admin.data.pasien
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

        return view('admin.patient.show', compact('patient', 'diseases', 'diseasesTaken', 'rooms'));
    }

    public function editDatapasien(Patient $patient)
    {
        $tanggalLahir = explode('-', $patient->tanggal_lahir);
        $patient['thn'] = $tanggalLahir[0];
        $patient['bln'] = $tanggalLahir[1];
        $patient['tgl'] = $tanggalLahir[2];
        $rooms = Room::withCount('patients')->orderBy('nomor_kamar')->get();
        $diseases = Disease::orderBy('nama_penyakit')->get();
        $diseasesPatient = Disease::whereIn('id', $patient->diseases->pluck('id')->all())->get();
        $diseasesTaken = $diseasesPatient->pluck('id')->toArray();
        return view('admin.patient.edit', compact('patient', 'diseases', 'diseasesTaken', 'rooms'));
    }

    public function destroyDataPasien(Patient $patient)
    {
        User::where('id', $patient->user->id)->first()->delete();
        return redirect()->route('admins.data.patient')->withSuccess("Pasien {$patient->nama} berhasil dihapus!");
    }

    //? admin.data.perawat
    public function dataPerawat()
    {
        $nurses = Nurse::paginate(5);
        return view('admin.nurse.data-perawat', compact('nurses'));
    }

    //? admin.dokter.dokter
    public function dataDokter()
    {
        $doctors = Doctor::orderBy('nama')->paginate(5);
        return view('admin.doctor.data-dokter', compact('doctors'));
    }
}
