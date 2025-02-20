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

    public function search(Request $request) {
        $search = $request->input('search'); 
        $students = Student::where('name', 'LIKE', "%$search%")->get();
    
        return response()->json($students);
    }
}
