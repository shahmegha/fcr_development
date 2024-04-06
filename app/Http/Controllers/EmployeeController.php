<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\EmployeesDataTable;

use App\Http\Requests\EmployeeAddEditRequest;

use App\Models\Employee;
use App\Models\Country;
use App\Models\State;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application Employee List.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employee.index');
    }
    
    public function add(EmployeeAddEditRequest $request)
    {
        $mode = $request->mode;
        if($mode == 'edit' && !empty($request->id) ){
            $employee = Employee::findOrFail($request->id);
            $message = 'Employee edited successfully';
        }else{
            $employee = new Employee();
            $message = 'Employee addded successfully';
        }
        $employee->name = $request->employee_name;
        $employee->email = $request->employee_email;
        $employee->country_id = (!empty($request->employee_country))?(int)$request->employee_country:null;
        $employee->state_id = (!empty($request->employee_state))?(int)$request->employee_state:null;
        if ($request->file('employee_image')){
            $file = $request->file('employee_image');
            $basePath = storage_path('app/public/uploads').DIRECTORY_SEPARATOR.'employees';
            $fileName = time() .'_'. md5($file->getClientOriginalName()) .'.'. $file->getClientOriginalExtension();
            $file->move($basePath, $fileName);
            $employee->image = $fileName;
        }
        $employee->save();
        return response()->json(['message'=>$message]);
    }
    
    public function detail($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $employee->image = $basePath = asset('uploads/employees/'.$employee->image);
        return response()->json(['message'=>'Employee detail found successfully','employee'=>$employee]);
    }
    
    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        if(!empty($employee->image)){
            $filename = $basePath = storage_path('app/public/uploads').DIRECTORY_SEPARATOR.'employees'.DIRECTORY_SEPARATOR.$employee->image;
            if (file_exists($filename)) {
                unlink($filename);
            }
        }
        $employee->delete();
        return response()->json(['message'=>'Employee deleted successfully']);
    }
    
    /**
     * Get all countries
     * @return type JSON Data
     */
    public function countries()
    {
        $countries = Country::select(['id','name'])->get();
        
        return response()->json(['message'=>'Country found successfully','countries'=>$countries]);
    }
    
    /**
     * Get all states by country
     * @return type JSON Data
     */
    public function states($country_id)
    {
        $states = State::select(['id','name'])->where('country_id',$country_id)->get();
        
        return response()->json(['message'=>'States found successfully','states'=>$states]);
    }
}
