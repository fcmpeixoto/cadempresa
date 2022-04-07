<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreUpdateRequest;
use App\Models\Companie;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{

    protected $employee;
    protected $companie;

    public function __construct(Employee $employee, Companie $companie)
    {
        $this->employee = $employee;
        $this->companie = $companie;
    }

    public function index()
    {
        //
        $rsEmployee = $this->employee->paginate(10);
        $rsCompanie = $this->companie->all();

        return view('admin.pages.employee.index',compact('rsEmployee','rsCompanie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rsCompanie = $this->companie->all();

        return view('admin.pages.employee.create',compact('rsCompanie'));
    }

    public function store(EmployeeStoreUpdateRequest $request)
    {

        try{

            DB::beginTransaction();

            $this->employee->create( [
                'companies_id' => $request->input('cboempresa'),
                'name'         => $request->input('txtnome'),
                'last_name'    => $request->input('txtsobrenome'),
                'email'        => $request->input('txtemail'),
                'telephone'    => $request->input('txttelefone'),

            ]);

            DB::commit();
            return redirect()->route('employee.index')->with('message', 'Registro gravado com sucesso.');

        }catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao gravar registro. '.$e->getMessage());

        }

    }

    public function show($id)
    {
        //
        if(!is_null($rsEmployee = $this->employee->find($id)))
        {
            $rsCompanie = $this->companie->all();

            return view('admin.pages.employee.edit',compact('rsEmployee','rsCompanie'));
        }else{
            return redirect()->route('employee.index')->with('error','Erro no retorno da busca!');
        };

    }

    public function edit($id)
    {
        //
    }

    public function update(EmployeeStoreUpdateRequest $request, $id)
    {

        if (!$rsEmployee = $this->employee->find($id)) {
            return redirect()->back()->with('error', 'Registro não encontrado.');
        }

        try{


            DB::beginTransaction();

            $rsEmployee->update( [
                'companies_id' => $request->input('cboempresa'),
                'name'         => $request->input('txtnome'),
                'last_name'    => $request->input('txtsobrenome'),
                'email'        => $request->input('txtemail'),
                'telephone'    => $request->input('txttelefone'),

            ]);


            DB::commit();
            return redirect()->route('employee.index')->with('message', 'Registro gravado com sucesso.');

        }catch (\Exception $e) {

            DB::rollBack();
            echo $e->getMessage();

        }

    }

    public function destroy($id)
    {
        //

        if (!$rsEmployee = $this->employee->find($id)) {
            return redirect()->back();
        }

        $rsEmployee->delete();

        return redirect()->route('employee.index')->with('message', 'Registro deletado com sucesso.');;
    }

    public function search(EmployeeStoreUpdateRequest $request)
    {
        $filters = $request->only('filter');

        $rsEmployee = $this->employee
            ->where(function($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('email', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.employee.companies.index', compact('rsEmployee', 'filters'));
    }
}
