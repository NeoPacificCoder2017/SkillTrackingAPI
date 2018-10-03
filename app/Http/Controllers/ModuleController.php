<?php

namespace App\Http\Controllers;

use App\Module;
use App\FormationDetail;
use App\Http\Resources\Module as ModuleR;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class ModuleController extends Controller
{
    public function all()
    {
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user()->id;

        if($authUserTypeId == 1):
            $modules = Module::select('modules.id as module_id', 'modules.name as module_name')
            ->paginate(25);

            return Response::json($modules);
        else:
          return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function show($moduleId)
    {
      return Response::json(Module::find($moduleId));
    }

    public function destroy($moduleId)
    {
      if(Auth::user()->user_type_id == 1):
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user()->id;
        
        $module = Module::findOrFail($moduleId);
        $formationDetail = FormationDetail::select('formation_details.*')->where('formation_details.module_id', $moduleId);
        $module->delete();
        $formationDetail->delete();

        return Response::json(["Succes : "=>"Le module '$module->name' a bien été supprimé"]);
      else:
        return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
      endif;
    }

    public function store(Request $request)
    {
      //si la méthode est un put, on effectue la modification
      if(Auth::user()->user_type_id == 1):
        if($request->isMethod('put')):
          $module = 
          Module::where([
          [ 'id', '=', $request->module_id],
          ])->get()->first();

          if(!empty($module)):
            $module->id = $request->input('module_id');
            $module->name = $request->input('name');
            $module->color = $request->input('color');
            $module->total_hours = $request->input('total_hours');
            $module->code = $request->input('code');

            // dd($module);

            if($module->save()):
              return new ModuleR($module);
            endif;
          endif;

        //fin de la modification, ici on crée un nouveau commentaire
        else:
        $module = Module::where([[ 'id', '=', $request->module_id],])->get()->first(); 
        $input = $request->all();

        $dataFormation = $request->all();
        $dataFormation['formation_id'] = $request->input('formation_id');
          // dd($dataFormation);
        $module = Module::create($input);
        DB::table('formation_details')->insert([
            'formation_id' => $request->input('formation_id'),
            'teacher_id' => $request->input('teacher_id'),
            'module_id' => $module->id
        ]);
        
        return response::json($module);
        endif;
      else:
        return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
      endif;
    }

    public function getAllModulesByFormationId($formationId)
    {
      $modules = FormationDetail::select('*')
        ->join('modules', 'modules.id', 'formation_details.module_id')
        ->groupBy('formation_details.formation_id')->get();
        return Response::json($modules);
    }
}
