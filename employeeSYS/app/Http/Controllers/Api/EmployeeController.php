<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
    private string $filePath = 'employees.json';

    public function index() 
    {
        $employees = $this->getEmployees();
        return view('employees.employeeList', compact('employees'));
    }

    public function create()
    {
        return view('employees.employeeForm'); 
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employees = $this->getEmployees();

        // Check duplicate email
        if (collect($employees)->pluck('email')->contains($request->email)) {
            return response()->json([
                'errors' => [
                    'email' => ['This email is already registered.']
                ]
            ], 422);
        }

        $data = $request->validated();
        $data['id'] = 'EMP-' . strtoupper(uniqid());
        $data['created_at'] = now()->format('Y-m-d H:i:s');

        $employees[] = $data;

        $saved = Storage::disk('public')->put(
            $this->filePath,
            json_encode($employees, JSON_PRETTY_PRINT)
        );

        if (!$saved) {
            return response()->json([
                'message' => 'Failed to save employee. Please try again.'
            ], 500);
        }

        return response()->json([
            'message' => 'Employee created successfully.'
        ], 200);
    }

    private function getEmployees(): array
    {
        if (!Storage::disk('public')->exists($this->filePath)) {
            Storage::disk('public')->put($this->filePath, json_encode([]));
        }
        return json_decode(Storage::disk('public')->get($this->filePath), true) ?? [];
    }

}
