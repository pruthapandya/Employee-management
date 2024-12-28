<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employee.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required|regex:/^(\+?\d{1,4}[\s-])?(\(?\d{1,3}\)?[\s-]?)?[\d\s-]{7,15}$/',
            'gender' => 'required|in:male,female,other',
            'department_id' => 'required|exists:departments,id',
            'profile_picture' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);
            // Start of Selection
            if ($request->hasFile('profile_picture')) {
                $profilePicture = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

        Employee::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'gender' => $validated['gender'],
            'department_id' => $validated['department_id'],
            'profile_picture' => $profilePicture ?? null,
        ]);

        return redirect()->route('employee.index');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employee.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone_number' => 'required|regex:/^(\+?\d{1,4}[\s-])?(\(?\d{1,3}\)?[\s-]?)?[\d\s-]{7,15}$/',
            'gender' => 'required|in:male,female,other',
            'department_id' => 'required|exists:departments,id',
            'profile_picture' => 'nullable|image|mimes:jpg,png|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($employee->profile_picture) {
                Storage::delete($employee->profile_picture);
            }
            $profilePicture = $request->file('profile_picture')->store('profile_pictures');
        }

        $employee->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'gender' => $validated['gender'],
            'department_id' => $validated['department_id'],
            'profile_picture' => $profilePicture ?? $employee->profile_picture,
        ]);

        return redirect()->route('employee.index');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->profile_picture) {
            Storage::delete($employee->profile_picture);
        }

        $employee->delete();
        return redirect()->route('employee.index');
    }
}
