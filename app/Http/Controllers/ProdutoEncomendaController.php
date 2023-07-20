<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\ProdutoEncomenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoEncomendaController extends Controller
{
    public function produto_add(Request $request, $id){
        try{
            $encomenda = Encomenda::find($id);

            foreach($request->produtosQtd as $produtoString){
                $parms = explode("@", $produtoString);
                $produtoFind = ProdutoEncomenda::where([
                    "encomenda_id" => $encomenda->id,
                    "produto_id" => $parms[0],
                ])->first();
                if(!isset($produtoFind->id)){
                    ProdutoEncomenda::create([
                        "encomenda_id" => $encomenda->id,
                        "produto_id" => $parms[0],
                        "quantidade_produto" => $parms[1],
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ]);
                }else{
                    $produtoFind->update([
                        "quantidade_produto" => $parms[1],
                        'updated_by' => Auth::user()->id,
                    ]);
                }
            }
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        }catch(\Exception $e){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function produto_list(Request $request, $id){
        try{
            $produtoEncomenda = ProdutoEncomenda::find($request->encomenda_produto_id);
            $produtoEncomenda->delete();
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        }catch(\Exception){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }


    public function produto_list_json($id){
        $produtos = ProdutoEncomenda::join('produtos','produto_id','produtos.id')
                ->join('encomendas','encomenda_id','encomendas.id')
                ->where('encomenda_id',$id)
                ->select('produto_encomenda.id','produtos.nome','produtos.preco','quantidade_produto')
                ->get();
        $total = 0;
        foreach($produtos as $produto){
            $total += $produto->preco * $produto->quantidade_produto;
        }
        return (object)[
            "produtos" => $produtos,
            "total" => $total,
        ];
    }

}
