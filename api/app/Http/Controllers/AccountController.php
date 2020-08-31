<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AccountService;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{

    protected $service;

    public function __construct(){
      $this->service = new AccountService();
    }
  
    /**
     *save a new acount.
     *
     * @param  AccountRequest  $request
     * @return Json Object
     */
    public function save(AccountRequest $request)
    {
     return $this->service->save($request);
    }

    /**
     *login
     *
     * @param  Request  $request
     * @return Json Object
     */
    public  function login(Request $request){
      return $this->service->login($request);
    }

     /**
     *saldo
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function balance(Request $request){
      //metodo balance similar ou metodo de login, que retorna apenas o saldo da conta 
      return  $this->service->balance($request);
    }

     /**
     *deposito
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function deposit(Request $request){
      return  $this->service->deposit($request);
    }

     /**
     *saque
     *
     * @param  Request  $request
     * @return Json Object
     */
    public function withdraw(Request $request){
      return  $this->service->withdraw($request);
    }
}