<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\admin\ValidRoleRequest;

use App\Http\Resources\open\EmployeeResource;
use App\Http\Resources\open\RoleResource;

use App\Models\Employee;
use Spatie\Permission\Models\Role;

class EmployeeManagementController extends Controller
{
    public function getEmployees()
    {
        return EmployeeResource::collection(Employee::with(["unit" , "roles"])->get());
    }

    public function getRoles()
    {
        return RoleResource::collection(Role::all());
    }

    public function assignRole(Employee $employee, ValidRoleRequest $request)
    {
        $employee->assignRole(Role::find($request->validated("roleId"))->name);
        return response()->json([
            "message" => "role assigned successfully"
        ], 200);
    }
}
