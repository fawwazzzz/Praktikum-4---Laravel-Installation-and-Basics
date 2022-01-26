<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        if(count($students) > 0) {
            $data = [
                'message' => 'Get All Students',
                'data' => $students
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data is empty'
            ];
            return response()->json($data, 200);
        }

    }

    public function store(Request $request) {
        $student = Student::create($request->all());
        $data = [
            'message' => 'Student is created',
            'data' => $student
        ];

        return response()->json($data, 201);
    }

    public function show(Request $request, $id) {
        $student = Student::find($id); 

        if ($student) {
            $data = [
                'message' => 'Get Detail Student',
                'data' => $student
            ];
    
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data not found'
            ];
            return response()->json($data, 404);
        }               
    }

    public function update(Request $request, $id) {
        $student = Student::find($id);

        if ($student){
            $student->update([
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan
            ]);

            $data = [
                'message' => 'Student is updated',
                'data' => $student
            ];
            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Data not found'
            ];
            return response()->json($data, 404);
        }

        
    }

    public function destroy($id) {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            $data = [
                'message' => 'Student is delete',
                'data' => $student
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
