<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $patients = Patient::where('room_id', Auth::user()->nurse->room_id)->get();
        return view('nurse.home', compact('patients'));
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
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function show(Nurse $nurse)
    {
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
        return view('nurse.edit', compact('nurse'));
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
        $data = $request->validate(
            [
                'nip'           => 'required|integer|min:8|unique:nurses,nip,' . $nurse->id,
                'nama'          => 'required|string|max:50',
                'email'         => 'required|email|unique:users,email,' . $nurse->user->id,
                'alamat'        => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'handphone'     => 'required|integer',
                'photo'         => 'file|image|max:5000',
            ]
        );

        if ($request->hasFile('photo')) {
            $namaFile = Str::slug($request->nama) . '-' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('public/uploads/image', $namaFile);
        } else {
            $namaFile = $nurse->photo ?? 'default_profile.jpg';
        }

        $data['photo'] = $namaFile;

        User::where('id', Auth::user()->id)->first()->update(
            [
                'email' => $request->email
            ]
        );

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
        //
    }
}
