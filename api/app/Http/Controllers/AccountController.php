<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AccountService;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{


    /**
     *save a new acount.
     *
     * @param  AccountRequest  $request
     * @return Json Object
     */
    public function save(AccountRequest $request)
    {
     return AccountService::save($request);
    }

    /**
     *login
     *
     * @param  Request  $request
     * @return Json Object
     */
    public  function login(Request $request){
      return AccountService::login($request);
    }

     /**
     *saldo
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function balance(Request $request){
      //metodo balance similar ou metodo de login, que retorna apenas o saldo da conta 
      return AccountService::balance($request);
    }

     /**
     *deposito
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function deposit(Request $request){
      return AccountService::deposit($request);
    }

     /**
     *saque
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function withdraw(Request $request){
      return AccountService::withdraw($request);
    }
}