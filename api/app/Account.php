<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'number';
    public $timestamps = false;

    

   public static function populate($request){
        if (isset($request->id)) {
            $obj = Account::find($request->id);
        } else {
            $obj = new Self();
            $obj->number = $request->number;
            $obj->agency = $request->agency;
            $obj->holder =$request->holder;
            $obj->balance = 0;
        }
         //edição apenas da senha
        $obj->password = ''.bcrypt($request->password);
        return $obj;
    }

}
