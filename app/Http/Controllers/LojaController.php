<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    public function public(Request $request){
        if(isset(Auth::user()->id))
            return redirect()->route('loja.auth');
        $data = $this->produtos($request);
        $data['route'] = route('loja.public');
        return view('pages.loja.public',$data);
    }

    public function auth(Request $request){
        $data = $this->produtos($request);
        $data['panel'] = 'loja';
        $data['route'] = route('loja.auth');
        return view('pages.loja.auth',$data);
    }

    public function produtos(Request $request){

        $auth = null;
        $id = Auth::user()->id ?? null;
        if(isset($id)){
            $auth = User::with('cliente','funcionario')->find($id);
        }

        if(isset($request->search)){
            $produtos = Produto::where('nome','like',"%{$request->search}%")->paginate();
            return ["produtos" => $produtos, "auth" => $auth, "search" => true];
        }

        $produtos = Produto::paginate();
        return ["produtos" => $produtos, "auth" => $auth];
    }



    public function encomenda(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $encomenda = Encomenda::create($data);
                $encomenda->produtos()->sync([
                    $encomenda->id => [
                        'produto_id' => $data['produto_id'],
                        'quantidade_produto' => $data['quantidade_produto'],
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id
                    ]
                ]);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

}
