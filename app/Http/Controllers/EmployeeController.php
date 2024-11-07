<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    // ensure that only admin user has access to the functions except for index
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasRole('Admin')) {
                abort(403);
            }

            return $next($request);
        })->except(['index']);
    }

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // retrieve employee data from database using pagination for 10 records
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function edit(string $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $employee = Employee::with('company')->findOrFail($id);
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    // data validation is done by EmployeeUpdateRequest class
    public function update(EmployeeUpdateRequest $request, string $id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->validated());

        return redirect()->route('employees.index')
            ->with('success', __('Employee updated successfully!'));
    }

    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $companies = Company::all();

        return view('employees.create', compact('companies'));
    }

    // data validation is done by EmployeeCreateRequest class
    public function store(EmployeeCreateRequest $request): RedirectResponse
    {
        Employee::create($request->validated());

        return redirect()->route('employees.index')
            ->with('success', __('Employee added successfully!'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', __('Employee deleted successfully!'));
    }
}
