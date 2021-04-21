<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Doctor;
use App\Models\Nurse;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
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
        $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $tanggal = $date->format('Y-m-d');
        $waktu = $date->format('H:i:s');

        $userId = Auth::user()->hasRole('doctor') ? Auth::user()->doctor->id : Auth::user()->nurse->id;

        $attendance = Attendance::where(
            [
                ['attendanceable_id', $userId],
                ['tanggal', $tanggal]
            ]
        )->first();

        if ($attendance) {
            return back()->withWarning("Anda sudah absensi kehadiran pada jam {$waktu}");
        } else {
            if (Auth::user()->hasRole('doctor')) {
                $doctor = Doctor::where('id', $userId)->first();
                $doctor->attendances()->createMany(
                    [
                        'tanggal' => $tanggal,
                        'jam_masuk' => $waktu
                    ]
                );
                $attendance = Attendance::where(
                    [
                        ['attendanceable_id', $userId],
                        ['tanggal', $tanggal]
                    ]
                )->first();
                return back()->withSuccess("Anda sudah melakukan absensi pada pukul {$attendance->jam_masuk}");
            } elseif (Auth::user()->hasRole('nurse')) {
                $nurse = Nurse::where('id', $userId)->first();
                $nurse->attendances()->createMany(
                    [
                        [
                            'tanggal' => $tanggal,
                            'jam_masuk' => $waktu
                        ],
                    ]
                );
                $attendance = Attendance::where(
                    [
                        ['attendanceable_id', $userId],
                        ['tanggal', $tanggal]
                    ]
                )->first();
                return back()->withSuccess("Anda sudah melakukan absensi pada pukul {$attendance->jam_masuk}");
            }
        }
    }

    public function outAttendance()
    {
        $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $tanggal = $date->format('Y-m-d');
        $waktu = $date->format('H:i:s');

        $userId = Auth::user()->hasRole('doctor') ? Auth::user()->doctor->id : Auth::user()->nurse->id;

        $attendance = Attendance::where(
            [
                ['attendanceable_id', $userId],
                ['tanggal', $tanggal]
            ]
        )->first();

        $data = [
            'jam_keluar' => $waktu,
            'jam_kerja'  => date('H:i:s', strtotime($waktu) - strtotime($attendance->jam_masuk))
        ];

        if ($attendance->jam_keluar == null) {
            if (Auth::user()->hasRole('doctor')) {
                $doctor = Doctor::where('id', $userId)->first();
                $doctor->attendances()->update($data);
                return back()->withSuccess("Anda sudah melakukan absensi keluar pada pukul {$data['jam_keluar']}");
            } elseif (Auth::user()->hasRole('nurse')) {
                $nurse = Nurse::where('id', $userId)->first();
                $nurse->attendances()->update($data);
                return back()->withSuccess("Anda sudah melakukan absensi keluar pada pukul {$data['jam_keluar']}");
            }
        } elseif ($attendance->jam_keluar != null) {
            return back()->withWarning("Anda sudah absensi keluar kerja pada jam {$attendance->jam_keluar}!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
