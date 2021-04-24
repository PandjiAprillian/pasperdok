<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::orderBy('nama_penyakit')->paginate(5);
        return view('admin.disease.data-penyakit', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.disease.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama_penyakit' => 'required|min:5|max:50'
            ]
        );

        Disease::create($data);
        $newDiseaseID = Disease::where('nama_penyakit', $request->nama_penyakit)->first();
        return redirect()->route('diseases.show', ['disease' => $newDiseaseID->id])->withSuccess("Penyakit {$request->nama_penyakit} berhasil di tambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        return view('admin.disease.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease)
    {
        $doctors = Doctor::orderBy('nama')->get();
        $spesialists = $disease->doctors->pluck('id')->all();
        return view('admin.disease.edit', compact('disease', 'doctors', 'spesialists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        $data = $request->validate(
            [
                'nama_penyakit' => 'required|max:50',
            ]
        );

        $disease->update($data);

        return redirect()->route('diseases.show', ['disease' => $disease->id])->withSuccess("Data penyakit {$disease->nama_penyakit} berhasil di update!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease)
    {
        $disease->delete();
        return redirect()->route('diseases.index')->withSuccess("Data penyakit {$disease->nama_penyakit} berhasil dihapus!");
    }
}
