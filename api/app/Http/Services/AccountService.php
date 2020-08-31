<?php 

namespace App\Http\Services;

use DB;
use Illuminate\Support\Facades\Hash;
use App\Account;

class AccountService
{

    public static function save($request)
    {
      $account = Account::populate($request);
      DB::beginTransaction();
      try {
        $account->save();
        DB::commit();
        return response()->json("Conta Salva!");
      } catch (\PDOException $exc) {
        DB::rollback();
        $err = $exc->getMessage();
        return response()->json(['err'=>$err,'msg'=>'Não foi possivel salvar esta conta'],500);
      }
    }

    public  static function login($request){
        $account = Account::select('holder','number','agency','balance','password')
        ->where('number',$request->number)
        ->where('agency',$request->agency)
        ->first();
        if ($account != null && Hash::check($request->password, $account->password)) {
            unset($account->password);
            return response()->json(["credentials"=>$account]);
        } else {
            return response()->json('Dados inválidos ou Senha Incorreta',403);
        }
    }

    //metodo balance similar ou metodo de login, que retorna apenas o saldo da conta 
    public static function balance($request){
        $account = Account::select('balance','password')
        ->where('number',$request->number)
        ->where('agency',$request->agency)
        ->first();
        if ($account != null && Hash::check($request->password, $account->password)) {
            unset($account->password);
            return response()->json($account);
        } else {
            return response()->json('Conta não encontrada.',403);
        }
    }

    public static function deposit($request){
      $account = Account::find($request->number);
      if(!$account){
        return response()->json('Conta não encontrada.',403);
      }
      if($account->agency != $request->agency){
        return response()->json('Agencia não encontrada.',403);
      }
      $account->balance +=  $request->deposit;
      DB::beginTransaction();
      try {
        $account->save();
        DB::commit();
        return response()->json("Deposito Realizado");
      } catch (\PDOException $exc) {
        DB::rollback();
        $err = $exc->getMessage();
        $msgUser = "Falha ao realizar transação.";
        return response()->json([err=>$err,msg=>msgUser],500);
      }
    }

    public static function withdraw($request){
      $account = Account::find($request->number);
      if($account->agency != $request->agency){
        return response()->json('Agencia não encontrada.',403);
      }
      if(!$account){
        return response()->json('Conta não encontrada.',403);
      }
      if(!Hash::check($request->password, $account->password)){
        return response()->json('Senha incorreta.',403);
      }
      if($account->balance < $request->withdraw){
        return response()->json('Saldo insuficiente.',403);
      }

      $account->balance -=  $request->withdraw;
      DB::beginTransaction();
      try {
        $account->save();
        DB::commit();
        return response()->json("Saque Realizado");
      } catch (\PDOException $exc) {
        DB::rollback();
        $err = $exc->getMessage();
        $msgUser = "Falha ao realizar transação.";
        return response()->json([err=>$err,msg=>msgUser],500);
      }
    }
}