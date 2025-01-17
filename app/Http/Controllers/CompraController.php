<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\ProdutoCompra;
use Illuminate\Http\Request;
use App\Utils\FileUploadUtil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /* Abrir o painel de controlo dos compras */
    public function index()
    {
        $panel = "compras";
        $compras = Compra::with('cliente.user','produtos')->orderBy('id', 'DESC');
        $cliente_id = Auth::user()->cliente->id ?? null;
        if(isset($cliente_id)){
            $compras = $compras->where('cliente_id',$cliente_id);
        }

        $compras = $compras->paginate();
        return view('pages.compra', compact('compras', 'panel'));
    }

    /* Cadastra uma compra no sistema */
    public function store(Request $request)
    {
        try {
            $request->validate(["file"=>"required"]);

            DB::transaction(function () use ($request) {
                $tam = count($request->qtd);

                $data = $request->all();

                $data["cliente_id"] = $request->cliente_id;
                $data["created_by"] = auth()->user()->id;
                $data["updated_by"] = auth()->user()->id;

                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $file->storeAs('comprovativo', $fileName, 'public');
                    $data['file'] = $filePath;
                }

                $totalCompra = 0;
                $compra = Compra::create($data);
                for($i = 0; $i < $tam; $i++){
                    $produto_id = $request->produto_id[$i];
                    $total = $request->qtd[$i] * $request->preco[$i];
                    $totalCompra += $total;
                    ProdutoCompra::create([
                        'total' => $total,
                        'compra_id' => $compra->id,
                        'qtd' => $request->qtd[$i],
                        'preco' => $request->preco[$i],
                        'produto_id' => $request->produto_id[$i],
                        "created_by" => auth()->user()->id,
                        "updated_by" => auth()->user()->id,
                    ]);
               }
               $compra->update(["total"=>$totalCompra]);
               $cliente = Cliente::find($data['cliente_id']);
               $cliente->update(['frequencia_compra' => $cliente->frequencia_compra + 1]);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    /* Actualizar o dados de uma compra */
    public function update(Request $request, $id)
    {
        try {
            $compra = Compra::find($id);

            $cliente_id = Auth::user()->cliente->id ?? null;
            $funcionario_id = Auth::user()->funcionario->id ?? null;

            if(!isset($funcionario_id))
                if($cliente_id != $compra->cliente_id){
                    toastr()->warning("Não podes alterar esta compra", "Aviso");
                    return redirect()->back();
                }


            DB::transaction(function () use ($request, $compra) {
                $data = $request->all();
                $produto = Produto::find($request->produto_id);

                $stock = $produto->quantidade_stock - $request->quantidade_compra;

                if($stock < 0){
                    toastr()->warning("No stock não temos a quantidade do produto pedido pelo cliente", "Aviso");
                    return redirect()->back();
                }

                $data['preco'] = $produto->preco * $request->quantidade_compra;

                if($data['valor_compra_view'] != $data['preco']){
                    toastr()->warning("Conflito no cálculo o valor a pagar", "Aviso");
                    return redirect()->back();
                }

                $troco = $data['valor_compra_view'] < $data['valor_compra']
                 ? $data['valor_compra'] - $data['valor_compra_view']
                 : $data['valor_compra_view'] - $data['valor_compra'];

                $produto->update([
                    'quantidade_stock' =>  $stock
                ]);
                $data['troco'] = $troco;

                $data['updated_by'] = Auth::user()->id;
                FileUploadUtil::uploadClienteCompra($request, $compra, $data);
                $compra->update($data);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('compras.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('compras.index');
        }
    }

    public function destroy($id)
    {
        try {
            $compra = Compra::find($id);
            $compra->delete();
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('compras.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('compras.index');
        }
    }

}
