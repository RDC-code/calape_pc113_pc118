<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; 

class EmployeeController extends Controller
{
    public function employee()
    {
        return response()->json(Employee::all());
    }
    public function search(Request $request) {
        $search = $request->input('search'); 
        $employees = Employee::where('name', 'LIKE', "%$search%")->get(); 
    
        return response()->json($employees);
    }
    

}
