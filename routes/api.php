<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {

	Route::apiResources(['users'=> 'UserController']);
	Route::apiResources(['roles'=> 'RoleController']);
	Route::apiResources(['branches'=> 'BranchController']);
	Route::apiResources(['centa'=> 'CentaController']);
	Route::apiResources(['attendance'=> 'AttendanceController']);

	Route::get('load-users-for-branch', 'UserController@loadUsersForBranch');
	Route::get('load-users-for-centa', 'CentaController@loadUsersForCenta');
	Route::get('load-branches-for-centa', 'CentaController@loadBranchesForCenta');
	Route::get('load-centa-for-attendance', 'AttendanceController@loadCentaForAttendance');


});

