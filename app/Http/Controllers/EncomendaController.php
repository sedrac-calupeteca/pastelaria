<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\ProdutoEncomenda;
use App\Utils\FileUploadUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EncomendaController extends Controller
{
    public function index()
    {
        $panel = "encomendas";
        $encomendas = Encomenda::with('cliente.user','produtos')->orderBy('id', 'DESC');
        $cliente_id = Auth::user()->cliente->id ?? null;
        if(isset($cliente_id)){
            $encomendas = $encomendas->where('cliente_id',$cliente_id);
        }
        $encomendas = $encomendas->paginate();
        return view('pages.encomenda', compact('encomendas', 'panel'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate(["file"=>"required"]);
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $file->storeAs('comprovativo', $fileName, 'public');
                    $data['file'] = $filePath;
                }

                $totalCompra = 0;
                $tam = count($request->qtd);
                $encomenda = Encomenda::create($data);
                for($i = 0; $i < $tam; $i++){
                    $produto_id = $request->produto_id[$i];
                    $total = $request->qtd[$i] * $request->preco[$i];
                    $totalCompra += $total;
                    ProdutoEncomenda::create([
                        'total' => $total,
                        'encomenda_id' => $encomenda->id,
                        'quantidade_produto' => $request->qtd[$i],
                        'preco' => $request->preco[$i],
                        'produto_id' => $request->produto_id[$i],
                        "created_by" => auth()->user()->id,
                        "updated_by" => auth()->user()->id,
                    ]);
               }

            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $encomenda = Encomenda::find($id);

                $cliente_id = Auth::user()->cliente->id ?? null;
                $funcionario_id = Auth::user()->funcionario->id ?? null;

                if(!isset($funcionario_id))
                    if($cliente_id != $encomenda->cliente_id){
                        toastr()->warning("Não podes alterar esta compra", "Aviso");
                        return redirect()->back();
                    }

                FileUploadUtil::uploadClienteCompra($request, $encomenda, $data);
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $encomenda->update($data);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $encomenda = Encomenda::find($id);
                $encomenda->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function atender($id){
        $encomenda = Encomenda::find($id);
        $encomenda->update(['atendido'=> !$encomenda->atendido]);
        toastr()->success("Operação realizada com sucesso", "Successo");
        return back();
    }

}
