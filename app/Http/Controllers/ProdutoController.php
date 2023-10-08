<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    private $STORE_PATH = "produtos";

    public function index(Request $request)
    {
        $panel = "produtos";
        $produtos = Produto::orderBy('id', 'DESC');
        if(isset($request->chave, $request->valor)){
            $produtos = $produtos->where($request->chave,'like',"%{$request->valor}%");
        }
        $produtos = $produtos->paginate();
        return view('pages.produto', compact('produtos', 'panel'));
    }

    public function store(Request $request)
    {
        try {

            if(!$request->hasFile('image')){
                toastr()->warning("Insira a imagem do produto", "Aviso");
                return redirect()->back();
            }

            DB::transaction(function () use ($request) {
                $data = $request->all();
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $file->storeAs("produtos", $fileName,'public');
                    $data['image'] = $filePath;
                }
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                Produto::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $produto = Produto::find($id);
            $data = $request->all();
            DB::transaction(function () use ($request, $produto) {
                $data = $request->all();
                if ($request->hasFile('image')) {
                    if ($produto->image) {
                        $existingFilePath = Storage::disk('public')->exists($produto->image);
                        if ($existingFilePath)
                            Storage::disk('public')->delete($produto->image);
                    }
                    $file = $request->file('image');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $file->storeAs($this->STORE_PATH, $fileName, 'public');
                    $data['image'] = $filePath;
                }
                $produto->update($data);
            });

            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('produtos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('produtos.index');
        }
    }

    public function destroy($id)
    {
        try {
            $produto = produto::find($id);
            $produto->delete();
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('produtos.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('produtos.index');
        }
    }

    public function photo(Request $request, $id)
    {
        try {
            $produto = Produto::find($id);
            DB::transaction(function () use ($request, $produto) {
                $data = $request->all();
                if ($request->hasFile('file')) {
                    if (isset($produto->image)) {
                        $existingFilePath = Storage::disk('public')->exists($produto->image);
                        if ($existingFilePath)
                            Storage::disk('public')->delete($produto->image);
                    }
                    $file = $request->file('file');
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $fileExtension;
                    $filePath = $file->storeAs($this->STORE_PATH, $fileName, 'public');
                    $data['image'] = $filePath;
                }
                $produto->update($data);
            });
            toastr()->success("Foto de perfil actualizar com successo", "Successo");
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error("Não foi possível actualizar foto de perfil", "Erro");
            return redirect()->back();
        }
    }


    public function json_search(Request $request){
        if(!isset($request->search) || empty($request->search)) return [];
        return Produto::where("nome","like","%{$request->search}%")->get();
    }

}
