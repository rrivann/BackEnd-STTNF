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

    function show($id) {
        $data = Student::find($id);

        if ($data == null) {
            $err = [
                'message' => 'data not found'
            ];
            return response()->json($err, 404);
        } else {
            return response()->json($data, 200);
        }

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

        $data = Student::find($id);

        if ($data) {
            $data -> update([
                'nama' => ($nama != null) ? $nama : $data->nama,
                'nim' => ($nim != null) ? $nim : $data->nim,
                'email' => ($email != null) ? $email : $data->email,
                'jurusan' => ($jurusan != null) ? $jurusan : $data->jurusan,
            ]);
            return response()->json($data, 200);
        } else {
            $err = [
                'message' => 'data not found'
            ];
            return response()->json($err, 404);
        }

    }

    function destroy($id) {
        $data = Student::find($id);

        if ($data) {
            $data->delete();
            $msg = [
                'message' => 'deleted succesfully'
            ];
            return response()->json($msg, 200);
        } else {
            $err = [
                'message' => 'data not found'
            ];
            return response()->json($err, 404);
        }
    }
}
