<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    # membuat method index
    public function index () 
    {
        # menggunakan model Student untuk select data
        $students = Student::all();
        $data = [
            'messege' => 'Get All Students' ,
            'data' => $students
        ];
        return response()->json($data, 200);
    }

    # membuat method store
    public function store (Request $request) 
    {
        # membuat validasi 
        $validatedData = $request->validate([
            # kolom => 'rules|rules'
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);
 

        # menggunakan model Student untuk insert data
        $student = Student::create($validatedData);

        $data = [
            'messege' => 'Student is created succesfully',
            'data' => $student
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    # membuat method show
    public function show($id)
    {
        $student = Student::find($id);
        
        if ($student) {
            $data = 
            [
                'messege' => 'Get detail student',
                'data' => $student
            ];
            return response()->json($data, 200);
        }
        else {
            $data = 
            [
                'messege' => 'Data not found',
            ];
            return response()->json($data, 404);
        }
    }

    # membuat method update
    public function update (Request $request, $id) 
    {
        # mencari id student yang ingin di update
        $student = Student::find($id);

        if ($student) {
            # menangkap data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ];
            # melaakukan update data
            $student->update($input);

            $data = [
                'messege' => 'Data is update',
                'data' => $student
            ];
            # mengmbalikan data (json) dan kode 200
            return response()->json($data, 200);
        }
        else {
            $data = 
            [
                'messege' => 'Data not found',
            ];
            return response()->json($data, 404);
        }
    }

    # membuat method destroy
    public function destroy($id) {
        # mencari data yang ingin dihapus
        $student = Student::find($id);

        if ($student) {
            # hapus data student
            $student->delete();

            $data = [
                'messege' => 'Data is deleted'
            ];
            # mengmbalikan data (json) dan kode 200
            return response()->json($data, 200);
        }

        else {
            $data = [
                'messege' => 'Data not found'
            ];
            return response()->json($data, 404);
        }
    }
}
