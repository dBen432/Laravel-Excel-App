<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Employee;
use Datatables;
use Rap2hpoutre\FastExcel\FastExcel;
use App\User;

// Load users
 
class EmployeeController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Employee::select('*'))
            ->addColumn('action', 'employee-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('index');
    }
 
    public function store(Request $request)
    {  
  
        $employeeId = $request->id;
  
        $employee   =   Employee::updateOrCreate(
                    [
                     'id' => $employeeId
                    ],
                    [
                    'name' => $request->name, 
                    'email' => $request->email,
                    'address' => $request->address
                    ]);    
                          
        return Response()->json($employee);
    }
 
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $employee  = Employee::where($where)->first();
       
        return Response()->json($employee);
    }
 
    public function destroy(Request $request)
    {
        $employee = Employee::where('id',$request->id)->delete();
       
        return Response()->json($employee);
    }
    public function export()
    {
        $employee = Employee::all();
        return (new FastExcel($employee))->download('employee_list.xlsx',function($employee){
            return [
                'Name' => $employee->name,
                'Email' => $employee->email,
                'Address' => $employee->address,
            ];
        });
    }
}