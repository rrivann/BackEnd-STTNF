<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    function index() {
        $data = Student::all();

        return $data;
    }

    function create(Request $request) {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::create([
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'jurusan' => $jurusan,
        ]);

        $data = [
            'message' => "student is created successfully",
            'data' => $student
        ];

        return response()->json($data, 201);
    }

    function update(Request $request, $id) {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        $student = Student::find($id);
        $student->nama = $nama;
        $student->nim = $nim;
        $student->email = $email;
        $student->jurusan = $jurusan;

        $student->save();

        $data = [
            'message' => "student is update successfully",
            'data' => $student
        ];

        return response()->json($data, 201);
    }

    function destroy($id) {
        $student = Student::find($id);
        $student->delete();

        $data = [
            'message' => "student is delete successfully",
            'data' => $this->index()
        ];

        return response()->json($data, 201);
    }
}
