<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Utils\FileUploadUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        if(!isset(Auth::user()->funcionario->id)){
            toastr()->warning("Permissáo negada", "Aviso");
            return redirect()->back();
        }
        $panel = "clientes";
        $users = User::join('clientes', 'user_id', 'users.id')->orderBy('users.id', 'DESC')->select('users.*');
        if(isset($request->chave, $request->valor)){
            $users = $users->where($request->chave,'like',"%{$request->valor}%");
        }
        $users = $users->paginate();
        return view('pages.user', compact('users', 'panel'));
    }

    public function store(Request $request)
    {
        try {
            if(!isset(Auth::user()->funcionario->id)){
                toastr()->warning("Permissáo negada", "Aviso");
                return redirect()->back();
            }
            if ($request->password_confirmation != $request->password) {
                toastr()->warning("Senhas são diferentes", "Aviso");
                return redirect()->route('clientes.index');
            }
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['created_by'] = Auth::user()->id;
                $data['updated_by'] = Auth::user()->id;
                $data['password'] = Hash::make($data['password']);
                if (!isset($data['frequencia_compra'])) {
                    $data['frequencia_compra'] = 0;
                }
                FileUploadUtil::uploadUserPhoto($request, null, $data);
                $user = User::create($data);
                $data['user_id'] = $user->id;
                Cliente::create($data);
            });
            toastr()->success("Operação de criação realizada com sucesso", "Successo");
            return redirect()->route('clientes.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('clientes.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if(!isset(Auth::user()->funcionario->id)){
                toastr()->warning("Permissáo negada", "Aviso");
                return redirect()->back();
            }
            DB::transaction(function () use ($request, $id) {
                $data = $request->all();
                $data['updated_by'] = Auth::user()->id;
                $user = User::find($id);
                FileUploadUtil::uploadUserPhoto($request, $user, $data);
                $user->update($data);
                $user->cliente()->update([
                    "frequencia_compra" => $request->frequencia_compra,
                    "updated_by" => Auth::user()->id,
                    "updated_at" => Carbon::now()
                ]);
            });
            toastr()->success("Operação de actualização realizada com sucesso", "Successo");
            return redirect()->route('clientes.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('clientes.index');
        }
    }

    public function destroy($id)
    {
        try {
            if(!isset(Auth::user()->funcionario->id)){
                toastr()->warning("Permissáo negada", "Aviso");
                return redirect()->back();
            }
            $user = User::find($id);
            $user->delete();
            toastr()->success("Operação de eliminação realizada com sucesso", "Successo");
            return redirect()->route('clientes.index');
        } catch (\Exception) {
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->route('clientes.index');
        }
    }

    public function json_search(Request $request){
        if(!isset($request->search) || empty($request->search)) return [];
        return User::join("clientes",'user_id','users.id')
                    ->where("users.name","like","%{$request->search}%")
                    ->select("users.email","users.name","clientes.id as cliente_id","users.image")
                    ->get();
    }

}
