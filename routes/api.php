<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\auth\authController;
use App\Http\Controllers\api\auth\studentAuthController;

// Open Controller Classes ::
use App\Http\Controllers\api\open\UnitController;

// Admin Controller Classes ::
use App\Http\Controllers\api\admin\EmployeeManagementController;
use App\Http\Controllers\api\admin\MaintenanceManagementController;
use App\Http\Controllers\api\admin\UnitManagementController;
use App\Http\Controllers\api\admin\MiscController;
use App\Http\Controllers\api\admin\SettingsController;

//


Route::group([] ,function () {
    Route::post("register", [authController::class, "register"]);
    Route::post("login", [authController::class, "login"]);
});

Route::prefix("std")->group(function () {
    Route::post("register" , [studentAuthController::class , "register"]);
    Route::post("login" , [studentAuthController::class , "login"]);
});


Route::group(["middleware" => "auth:employee"] , function () {

// Admin Routes ::
    Route::group(["middleware" => "role:admin" , "prefix" => "admin"] , function () {
        Route::group(["prefix" => "management"] , function () {
            Route::get("employees" , [EmployeeManagementController::class , "getEmployees"]);
            Route::get("roles" , [EmployeeManagementController::class , "getRoles"]);
            Route::post("{employee}" , [EmployeeManagementController::class , "assignRole"]);
        });
        Route::group(["prefix" => "maintenance"] , function () {
            Route::get("all" , [MaintenanceManagementController::class , "getMaintenanceRequests"]);
            Route::get("progress" , [MaintenanceManagementController::class , "getMaintenanceProgress"]);
            Route::post("{mRequest}/agree" , [MaintenanceManagementController::class , "agreeMaintenanceRequest"]);
        });
        Route::group(["prefix" => "units"] , function () {
            Route::get("/all" , [UnitController::class , "getUnitData"]);
            Route::get("/{unit}/storage" , [UnitController::class , "getUnitStorage"]);
            Route::get("/{unit}/rooms" , [UnitController::class , "getUnitRooms"]);
            
            Route::post("/{unit}/roomcap" , [UnitManagementController::class , "setUnitRoomCap"]);
            Route::post("/{unit}/gender" , [UnitManagementController::class , "setUnitGender"]);
        });
    });

// Mentor Routes ::
    Route::group(["middleware" => "role:mentor" , "prefix" => "mentor"] , function () {

    });

    Route::post("logout", [authController::class, "logout"]);

});



Route::group(["prefix" => "std" , "middleware" => "auth:student"] , function() {

    Route::post("logout" , [studentAuthController::class , "logout"]);

});
