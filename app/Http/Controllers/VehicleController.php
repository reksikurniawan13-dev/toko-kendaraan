<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tampilkan kendaraan
        $vehicles = \App\Models\Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
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
        // menyimpan data
        $request->validate(
            [
                'nama_kendaraan' => 'required',
                'merk' => 'required',
                'jenis' => 'required',
                'tahun' => 'required|numeric',
                'harga' => 'required|numeric',
                'stok' => 'required|numeric',
                'deskripsi' => 'required'
            ]
        );
        \App\Models\Vehicle::create($request->all());
        return redirect()->route('vehicles.index')->with('success', 'kendaraan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
