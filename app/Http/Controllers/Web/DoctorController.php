<?php

namespace App\Http\Controllers\Web;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;
use App\Models\Specialist;

class DoctorController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $paginateValue = $request->has('entires') ? $request->integer('entires') : $this->defaultPaginate;
        $data = Doctor::query()->when($search, function ($query, string $search) {
            $query->whereAny([
                'doctor_name',
                'sip',
                'id_ihs',
                'nik',
                'doctor_phone',
                'doctor_email',
                'doctor_address',
                'doctor_specialist_name',
            ], 'LIKE', "%$search%");
        })
            ->paginate($paginateValue)
            ->withQueryString(); // mengirim kembali value dari request seperti search

        $specialists = Specialist::all();
        $filters = $request->only(['search']);
        return inertia('Doctor/Index', compact('data', 'specialists', 'filters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sip'   => ['required'],
            'nik'   => ['nullable', 'unique:doctors,nik'],
            'doctor_name'   => ['required'],
            'doctor_phone'  => ['required'],
            'doctor_email'  => ['required', 'unique:doctors,doctor_email'],
            'specialist_id' => ['required', 'exists:specialists,id'],
            'doctor_profile_pict' => ['nullable', 'file', 'mimes:jpg,bpm,jpeg,png']
        ]);
        $path = null;
        if ($request->hasFile('doctor_profile_pict') && $request->file('profile_pict')->isValid()) {
            $path = $request->file('profile_pict')->store('doctor-pictures');
        }

        $specialistName = Specialist::where('id', $request->specialist_id)->first()->specialist_name;

        Doctor::create([
            'doctor_name'    => $request->doctor_name,
            'doctor_phone'   => $request->doctor_phone,
            'doctor_email'   => $request->doctor_email,
            'doctor_address' => $request->doctor_address,
            'specialist_id'  => $request->specialist_id,
            'sip'       => $request->sip,
            'id_ihs'    => $request->id_ihs,
            'nik'       => $request->nik,
            'doctor_specialist_name' => $specialistName,
            'doctor_profile_pict'    => $path
        ]);
        return back()->with('message', "Doctor created successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialists = Specialist::all();
        return inertia('Doctor/Edit', compact('doctor', 'specialists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $rules = [
            'sip'   => ['required'],
            'doctor_name'   => ['required'],
            'doctor_phone'  => ['required'],
            'specialist_id' => ['required', 'exists:specialists,id']
        ];
        if ($request->doctor_email !== $doctor->doctor_email) {
            $rules['doctor_email'] = ['required', 'max:50', 'unique:doctors,doctor_email'];
        }

        if ($request->nik !== $doctor->nik) {
            $rules['nik'] = ['required', 'max:50', 'unique:doctors,nik'];
        }

        if ($request->hasFile('doctor_profile_pict')) {
            $rules['doctor_profile_pict'] = ['file', 'mimes:jpg,bpm,jpeg,png'];
        }
        $request->validate($rules);

        isset($request->doctor_name)   && $doctor->doctor_name  = $request->doctor_name;
        isset($request->doctor_email)  && $doctor->doctor_email = $request->doctor_email;
        isset($request->doctor_phone)  && $doctor->doctor_phone = $request->doctor_phone;
        isset($request->doctor_address)  && $doctor->doctor_address = $request->doctor_address;
        isset($request->sip)  && $doctor->sip = $request->sip;
        isset($request->nik)  && $doctor->nik = $request->nik;
        isset($request->id_ihs)  && $doctor->id_ihs = $request->id_ihs;
        $specialistName = Specialist::where('id', $request->specialist_id)->first()->specialist_name;
        $doctor->doctor_specialist_name = $specialistName;

        if ($request->hasFile('doctor_profile_pict') && $request->file('doctor_profile_pict')->isValid()) {
            $path = $request->file('doctor_profile_pict')->store('doctor-pictures');
            $doctor->doctor_profile_pict = $path;
        }
        $doctor->save();
        return back()->with('message', "Doctor updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('message', "Doctor deleted successfully!");
    }
}
