<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{


    public function student()
    {
        return response()->json(Student::all());
    }



    //search
    public function search(Request $request) {
        $search = $request->input('search'); 
        $students = Student::where('name', 'LIKE', "%$search%")->get();
    
        return response()->json($students);
    }




    
    //Update
    public function update(Request $request, string $id) {
        $student = Student :: find($id);

        if (empty($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:students,email,' . $id,
            'phone' => 'string',
            'address' => 'string',
        ]);
        
        $student->update($request->all());
        return response()->json($student);
    }


    //show
    public function show (string $id) {
        $student = Student::find($id);
        if (empty($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }


    //delete
    public function delete(string $id) {
        $student = Student::find($id);
        if (empty($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json([
            'deleted' => $student->delete(),
            'message' => 'Student deleted successfully'
        ]);
    }


    //store
    public function store (Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);
        $student = Student::create($request->all());
        return response()->json($student, 201);
    }
  
}