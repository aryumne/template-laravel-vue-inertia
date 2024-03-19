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
    public function index()
    {
        $data = Doctor::paginate($this->defaultPaginate);
        $specialists = Specialist::all();
        return inertia('Doctor/Index', compact('data', 'specialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
