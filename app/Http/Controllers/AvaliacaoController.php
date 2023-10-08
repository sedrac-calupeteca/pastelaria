<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{
    public function encomenda_add(Request $request, $id){
        try{
            if(!isset(Auth::user()->cliente->id)){
                toastr()->warning("Permissáo negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['encomenda_id'] = $id;
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Avaliacao::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('encomendas.index');
        }catch(\Exception){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('encomendas.index');
        }
    }

    public function encomenda_put(Request $request, $id){
        try{
            if(!isset(Auth::user()->cliente->id)){
                toastr()->warning("Permissáo negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $find = Avaliacao::find($id);
                $find->update($data);
            });
            toastr()->success("Operação de actualizado realizada com sucesso", "Successo");
            return redirect()->back();
        }catch(\Exception){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function encomenda_list($id){
        $panel = "avaliações";
        $avaliacoes = Avaliacao::where('encomenda_id',$id)->paginate();
        return view('pages.avaliacao', compact('avaliacoes','panel'));
    }

    public function encomenda_delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $avaliacao = Avaliacao::find($id);
                $avaliacao->delete();
            });
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

}
