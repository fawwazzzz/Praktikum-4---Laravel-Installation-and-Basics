<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index() {
        # variabel menyimpan pasien
        $patients = Patient::all();
        # Kondisi, sekalian validasi data
        if(count($patients) > 0) {
            $data = [
                'message' => 'Get All Patients',
                'data' => $patients
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Patients is empty'
            ];
            return response()->json($data, 200);
        }
    }

    public function show(Request $request, $id) {
        # mencari pasien berdasarkan id
        $patients = Patient::find($id); 
        # Kondisi
        if ($patients) {
            $data = [
                'message' => 'Get Detail Patients',
                'data' => $patients
            ];
    
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Patient not found'
            ];
            return response()->json($data, 404);
        }  
    }
    
    public function store(Request $request) {
        # Validasi data agar data yg masuk dibatasi/tidak aneh-aneh
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'status_id' => 'required',
            'in_date_at' => 'required|date',
            'out_date_at' => 'required|date'
        ]);
        # Membuat data pasien
        $patient = Patient::create($request->all());
        $data = [
            'message' => 'Patient s created',
            'data' => $patient
        ];
    }

    public function update(Request $request, $id) {
        # Mengambil pasien berdasarkan id
        $patients = Patient::find($id);
        # kondisi, sekalian defaktor
        if ($patients){
            $patients->update([
                'name' => $request->name ?? $patients->name,
                'phone' => $request->phone ?? $patients->phone,
                'address' => $request->address ?? $patients->address,
                'status_id' => $request->status_id ?? $patients->status_id,
                'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
                'out_date_at' => $request->out_date_at ?? $patients->out_date_at,
            ]);

            $data = [
                'message' => 'Patient is updated',
                'data' => $patients
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Patient not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function destroy($id) {
        # Mengambil pasien berdasarkan id
        $patients = Patient::find($id);
        # kondisi, menghapus data
        if ($patients) {
            $patients->delete();
            $data = [
                'message' => 'Student is delete',
                'data' => $patients
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data not found'
            ];
        }
        return response()->json($data, 404);
    }
}
