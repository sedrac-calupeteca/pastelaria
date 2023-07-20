<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\FileUploadUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',['panel' => 'account']);
    }

    private function validPasswords($request): bool{
        if($request->password_confirmation != $request->password){
            toastr()->warning("Senhas(actual) são diferentes", "Aviso");
            return false;
        }
        if(Hash::check($request->password,Auth::user()->password)){
            toastr()->warning("Senha são inválida", "Aviso");
            return false;
        }
        return true;
    }

    public function update(Request $request){
        try{

            if(!$this->validPasswords($request))  return redirect()->back();

            $user = User::find(Auth::user()->id);
            $user->update($request->all());

            toastr()->success("Operação realizada com successo", "Successo");
            return redirect()->back();
        }catch(\Exception){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }

    public function password(Request $request){
        try{

            if(!$this->validPasswords($request))  return redirect()->back();

            if($request->password_confirmation_new != $request->password_new){
                toastr()->warning("Senhas(novas) são diferentes", "Aviso");
                return redirect()->back();
            }

            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->password_new)
            ]);

            toastr()->success("Operação realizada com successo", "Successo");
            return redirect()->back();
        }catch(\Exception){
            toastr()->error("Não foi possível a realização desta operação", "Erro");
            return redirect()->back();
        }
    }


    public function photo(Request $request, $id)
    {
        try {
            $user = User::find($id);
            DB::transaction(function () use ($request, $user) {
                $data = $request->all();
                FileUploadUtil::uploadUserPhoto($request,$user,$data);
                $user->update($data);
            });
            toastr()->success("Foto de perfil actualizar com successo", "Successo");
            return redirect()->back();
        } catch (\Exception $e) {
            toastr()->error("Não foi possível actualizar foto de perfil", "Erro");
            return redirect()->back();
        }
    }

}
