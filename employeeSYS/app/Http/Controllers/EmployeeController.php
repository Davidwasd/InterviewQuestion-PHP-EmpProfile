<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    private string $filePath = 'employees.json';

    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $employees = $this->getEmployees();
        return view('employees.employeeList', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.employeeForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    private function getEmployees(): array
    {
        if (!Storage::disk('public')->exists($this->filePath)) {
            Storage::disk('public')->put($this->filePath, json_encode([]));
        }
        return json_decode(Storage::disk('public')->get($this->filePath), true) ?? [];
    }
}
