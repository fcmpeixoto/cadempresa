<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanieStoreUpdateRequest;
use App\Models\Companie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CompanieController extends Controller
{
    protected $companie;

    public function __construct(Companie $companie)
    {
        $this->companie = $companie;
    }

    public function index()
    {
        //
        $rsCompanies = $this->companie->paginate(10);

        return view('admin.pages.companies.index',compact('rsCompanies'));
    }

    public function create()
    {
        //
        return view('admin.pages.companies.create');
    }

    public function store(CompanieStoreUpdateRequest $request)
    {

        $name = uniqid(date('HisYmd'));

        if ($request->hasFile('filelogotipo') && $request->file('filelogotipo')->isValid()) {

            $image    = $request->file('filelogotipo');
            $filename = "{$name}";

        }else{

            return redirect()->back()->with('error', 'Insira uma imagem válida.');

        }

        try{


            DB::beginTransaction();

            $this->companie->create( [
                'name'     => $request->input('txtnome'),
                'address'  => $request->input('txtendereco'),
                'website'  => $request->input('txtsite'),
                'email'    => $request->input('txtemail'),
                'logotipo' => $filename,

            ]);


            //$image->storeAs('temp',$filename,'public');
            Image::make($_FILES['filelogotipo']['tmp_name'])
                ->encode('image/webp')
                ->resize(1170, 717)
                ->save($_SERVER['DOCUMENT_ROOT'].'/storage/companies/logo/'.$name.'.webp');
            Image::make($_FILES['filelogotipo']['tmp_name'])
                ->encode('image/webp')
                ->resize(424, 260)
                ->save($_SERVER['DOCUMENT_ROOT'].'/storage/companies/logo/thumbs_'.$name.'.webp');

            DB::commit();
            return redirect()->route('companie.index')->with('message', 'Registro gravado com sucesso.');

        }catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao gravar registro. '.$e->getMessage());

        }

    }

    public function show($id)
    {
        //
        if(!is_null($rsCompanies = $this->companie->find($id)))
        {
            return view('admin.pages.companies.edit',compact('rsCompanies'));
        }else{
            return redirect()->route('companie.index')->with('error','Erro no retorno da busca!');
        };

    }

    public function edit($id)
    {
        //
    }

    public function update(CompanieStoreUpdateRequest $request, $id)
    {

        if (!$rsCompanie = $this->companie->find($id)) {
            return redirect()->back()->with('error', 'Registro não encontrado.');
        }

        try{

            $name = uniqid(date('HisYmd'));

            if ($request->hasFile('filelogotipo') && $request->file('filelogotipo')->isValid()) {

                $image    = $request->file('filelogotipo');
                $filename = "{$name}";

            }else{

                return redirect()->back()->with('error', 'Insira uma imagem válida.');

            }

            DB::beginTransaction();

            $rsCompanie->update( [
                'name'     => $request->input('txtnome'),
                'address'  => $request->input('txtendereco'),
                'website'  => $request->input('txtsite'),
                'email'    => $request->input('txtemail'),
                'logotipo' => $filename,
            ]);

            Image::make($_FILES['filelogotipo']['tmp_name'])
                ->encode('image/webp')
                ->resize(1170, 717)
                ->save($_SERVER['DOCUMENT_ROOT'].'/storage/companies/logo/'.$name.'.webp');
            Image::make($_FILES['filelogotipo']['tmp_name'])
                ->encode('image/webp')
                ->resize(424, 260)
                ->save($_SERVER['DOCUMENT_ROOT'].'/storage/companies/logo/thumbs_'.$name.'.webp');

            DB::commit();
            return redirect()->route('companie.index')->with('message', 'Registro gravado com sucesso.');

        }catch (\Exception $e) {

            DB::rollBack();
            echo $e->getMessage();

        }

    }

    public function destroy($id)
    {
        //

        if (!$rsCompanie = $this->companie->find($id)) {
            return redirect()->back();
        }

        if (Storage::disk('public')->exists('companies/logo/'.$rsCompanie->logotipo.'.webp')) {
            Storage::disk('public')->delete('companies/logo/'.$rsCompanie->logotipo.'.webp');
            Storage::disk('public')->delete('companies/logo/thumbs_'.$rsCompanie->logotipo.'.webp');
        }

        $rsCompanie->delete();

        return redirect()->route('companie.index')->with('message', 'Registro deletado com sucesso.');;
    }

    public function search(CompanieStoreUpdateRequest $request)
    {
        $filters = $request->only('filter');

        $rsCompanies = $this->companie
            ->where(function($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('site', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.companies.index', compact('rsCompanies', 'filters'));
    }
}
