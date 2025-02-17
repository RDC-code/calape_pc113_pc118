<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function student()
    {
        return response()->json(Employee::all());
    }
}
