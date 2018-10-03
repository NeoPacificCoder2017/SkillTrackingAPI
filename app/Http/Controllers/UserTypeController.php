<?php

namespace App\Http\Controllers;

use App\UserType;
use App\Http\Resources\UserType as UserTypeR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserTypeController extends Controller
{
    public function all()
    {
      $authUserTypeId = Auth::user()->user_type_id;
      $authUserId = Auth::user();

      if($authUserTypeId == 1):
        $usertypes = UserType::select('user_types.id as user_type_id', 'user_types.name as user_type_name')
        ->paginate(25);

        return Response::json($usertypes);
      else:
        return Response::json(['error'=>'accès non authorisé']);
      endif;
    }

    public function show($userTypeId)
    {
      $userTypeId = UserType::select('user_types.id as user_type_id', 'user_types.name as user_type_name')
      ->get()->first();

      return Response::json($userTypeId);
    }

    public function destroy($userTypeId)
    {
      $userType = UserType::findOrFail($userTypeId);
      if($userType->delete()):
        return new UserTypeR($userType);
      endif;
    }

    public function store(Request $request)
    {
      $authUserId = Auth::user()->id;

      //si la méthode est un put, on effectue la modification
      if($request->isMethod('put')):
        $usertype = 
          UserType::where([
            [ 'id', '=', $request->user_type_id],
          ])->get()->first();
  
        if(!empty($usertype)):
          $usertype->id = $request->input('user_type_id');
          $usertype->name = $request->input('name');
  
          // dd($usertype);
  
          if($usertype->save()):
            return new UserTypeR($usertype);
          endif;
  
        else:
          return Response::json(['error'=>'Vous ne pouvez pas modifier ce usertype']);
        endif;
      
      //fin de la modification, ici on crée un nouveau commentaire
      else:
        $input = $request->all();
        $usertype = UserType::create($input);
        return new UserTypeR($usertype);
      endif;
    }
}
