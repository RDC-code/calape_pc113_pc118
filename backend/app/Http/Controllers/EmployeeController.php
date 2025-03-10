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


    //search
    public function search(Request $request) {
        $search = $request->input('search'); 
        $employees = Employee::where('name', 'LIKE', "%$search%")->get(); 
     
        return response()->json($employees);
    }
    

    //Update
    public function update(Request $request, string $id) {
        $employee = Employee :: find($id);

        if (empty($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:employees,email,' . $id,
            'phone' => 'string',
            'position' => 'string',
            'salary' => 'numeric',
        ]);
        
        $employee->update($request->all());
        return response()->json($employee);
    }


    //show
    public function show (string $id) {
        $employee = Employee::find($id);
        if (empty($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        return response()->json($employee);
    }


    //delete
    public function delete(string $id) {
        $employee = Employee::find($id);
        if (empty($employee)) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        return response()->json
        ([
            'deleted' => $employee->delete(),
            'message' => 'Employee deleted successfully'
            ]);
    }


    //Store
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string',
            'position' => 'required|string',
            'salary' => 'required|numeric',
        ]);
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }
}