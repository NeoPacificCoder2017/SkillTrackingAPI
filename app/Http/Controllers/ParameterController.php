<?php

namespace App\Http\Controllers;

use App\Parameter;
use App\RequestDoc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Ressource utile pour la méthode Delete
use App\Http\Resources\Parameter as ParameterR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ParameterController extends Controller
{
    /**
     * Affiche la liste des parametre
     */
    public function all(){
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user()->id;

        if($authUserTypeId == 1):
            $Parameters = Parameter::select('request_docs.id as request_docs_id'
                                            ,'parameters.request_doc_id as parameters_request_doc_id'
                                            ,'parameters.name as parameters_name'
                                            ,'parameters.type as parameters_type'
                                            ,'parameters.position as parameters_position'
                                            ,'parameters.required as parameters_required'
                                            ,'parameters.description as parameters_description')
            ->leftjoin('request_docs','request_docs.id','=','parameters.request_doc_id')
            ->paginate(4);
            return Response::json($Parameters);
        else:
            return Response::json(['error'=>'acces non autoriser']);
        endif;
    }

    /**
     * Affiche le parametre selectionner
     */
    public function show($ParameterId)
    {
        $parameters = Parameter::select('id', 'request_doc_id'
                                        ,'name','type','position'
                                        ,'required','description')
            ->where('id', $ParameterId)
            ->get()->first();
        return Response::json($parameters);
    }

    /**
     * Mis a jour du parametre selectionner
     */
    public function store(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
          $parameters =
            Parameter::where([
              [ 'id', '=', $request->parameter_id],
            ])->get()->first();

          if(!empty($parameters)):
            $parameters->id = $request->input('parameter_id');
            $parameters->request_doc_id = $request->input('request_doc_id');
            $parameters->name = $request->input('name');
            $parameters->type = $request->input('type');
            $parameters->position = $request->input('position');
            $parameters->required = $request->input('required');
            $parameters->description = $request->input('description');

            if($parameters->save()):
              return new ParameterR($parameters);
            endif;

          else:
            return Response::json(['error'=>'Vous ne pouvez pas modifier de menu']);
          endif;

        //fin de la modification, ici on crée un nouveau parametr

        else:
          $input = $request->all();
          $parameters = Parameter::create($input);
          return new ParameterR($parameters);
        endif;
    }

    /**
     * Supprime l'élément séléctionner
     */
    public function destroy($ParameterId){
        $parameters = Parameter::findOrFail($ParameterId);
        if($parameters->delete()):
            return new ParameterR($parameters);
        endif;
        }

}
