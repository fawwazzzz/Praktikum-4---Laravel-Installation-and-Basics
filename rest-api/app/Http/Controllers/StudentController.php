<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index () 
    {
        $students = Student::all();
        $data = [
            'messege' => 'Get All Students' ,
            'data' => $students
        ];
        return response()->json($data, 200);
    }

    public function store (Request $request) 
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurursan' => $request->jurusan
        ]; 
        $student = Student::create($input);

        $data = [
            'messege' => 'Student is created',
            'data' => $student
        ];

        return response()->json($data, 201);
    }
}