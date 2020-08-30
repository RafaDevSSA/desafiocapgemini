<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Http\Requests\AccountRequest;
use App\Account;

class AccountController extends Controller
{
    /**
     *save a new acount.
     *
     * @param  AccountRequest  $request
     * @return View
     */
    public function save(AccountRequest $request)
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
        $msgUser = "Erro ao salvar Instrumento.";
        return response()->json([err=>$err,msg=>'Não foi possivel salvar esta conta'],500);
      }
    }

    public  function login(Request $request){
      $account = DB::table('account')
      ->where('number',$request->number)
      ->where('agency',$request->agency)
      ->where('password',$request->password);
      if($request->onlyBalance){
        $account->select('balance');
      }else{
        $account->select('holder','number','agency','balance');
      }

      return response()->json(["credentials"=>$account->first()]);
      //return response()->json($account);
    }

    public function deposit(Request $request){
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

    public function withdraw(Request $request){
      $account = Account::find($request->number);
      if(!$account){
        return response()->json('Conta não encontrada.',403);
      }
      if($account->agency != $request->agency){
        return response()->json('Agencia não encontrada.',403);
      }
      if($account->password != $request->password){
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