<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employee;
use Validator;
use App\Http\Resources\Employee as EmployeeResource;

class EmployeeController extends BaseController
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $employees = Employee::all();

        return $this->sendResponse(EmployeeResource::collection($employees), 'Employee retrieved successfully.');

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $input = $request->all();

        $validator = Validator::make($input, [

            'name' => 'required',
            'DoB' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'Phone_Number' => 'required',
            'Country_code' => 'required'

        ]);

   

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }
        $employee = Employee::create($input);
        return $this->sendResponse(new EmployeeResource($employee), 'Employee created successfully.');

    } 


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $employee = Employee::find($id);

  

        if (is_null($employee)) {

            return $this->sendError('Employee not found.');

        }

        return $this->sendResponse(new EmployeeResource($employee), 'Employee retrieved successfully.');

    }

    

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Employee $employee)

    {

        $input = $request->all();

   

        $validator = Validator::make($input, [

            'name' => 'required',
            'DoB' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'Phone_Number' => 'required',
            'Country_code' => 'required'

        ]);

   
        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $employee->name = $input['name'];

        $employee->DoB = $input['DoB'];
        $employee->LGA = $input['LGA'];
        $employee->state = $input['state'];
        $employee->Phone_Number = $input['Phone_Number'];
        $employee->Country_code= $input['Country_code'];
            
        $employee->save();

   

        return $this->sendResponse(new EmployeeResource($employee), 'Employee updated successfully.');

    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Employee $employee)

    {

        $employee->delete();
        return $this->sendResponse([], 'Employee deleted successfully.');

    }
}
