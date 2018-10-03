<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use App\Module;
use App\Formation;
use App\Progression;
use App\FormationDetail;
use App\Http\Resources\FormationDetail as FormationDetailR;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class FormationDetailController extends Controller
{
    public function all()
    {
        if(Auth::user()->user_type_id == 1):
            $formationdetails = FormationDetail::select('formation_details.id as formation_detail_id', 'formation_details.formation_id as formation_id', 'modules.name as module_name', 'formations.name as formation_name', 'users.lastname as teacher_lastname','users.firstname as teacher_firstname')
            ->leftjoin('modules', 'modules.id', '=', 'formation_details.module_id')
            ->leftjoin('users', 'users.id', '=', 'formation_details.teacher_id')
            ->leftjoin('formations', 'formations.id', '=', 'formation_details.formation_id')
            ->paginate(25);

            return Response::json($formationdetails);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function show($formationdetailId)
    {
        if(Auth::user()->user_type_id == 1):
            $formationdetailId = FormationDetail::select('formation_details.id as formation_detail_id', 'modules.name as module_name', 'formations.name as formation_name')
                ->leftjoin('modules', 'modules.id', '=', 'formation_details.module_id')
                ->leftjoin('formations', 'formations.id', '=', 'formation_details.formation_id')
                ->get()->first();

            return Response::json($formationdetailId);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function destroy($id)
    {
        if(Auth::user()->user_type_id == 1):
            $formationdetail = FormationDetail::findOrFail($id);
            $formationdetail->delete();
            return Response::json($formationdetail);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }


    public function store(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
          $formationDetail =
          FormationDetail::where([
              [ 'id', '=', $request->formation_detail_id],
            ])->get()->first();

          if(!empty($formationDetail)):
            $formationDetail->id = $request->input('formation_detail_id');
            $formationDetail->formation_id = $request->input('formation_id');
            $formationDetail->module_id = $request->input('module_id');
            $formationDetail->teacher_id = $request->input('teacher_id');

            // dd($formation);

            if($formationDetail->save()):
              return new FormationDetailR($formationDetail);
            endif;

          else:
            return Response::json(['error'=>'Vous ne pouvez pas modifier de menu']);
          endif;

        //fin de la modification, ici on crée un nouveau commentaire
        else:
          $input = $request->all();
          $formationDetail = FormationDetail::create($input);
          return new FormationDetailR($formationDetail);
        endif;
    }

    // Récupérer les modules de l'utilisateur connecté 
    public function getModulesByAuthUser()
    {
        $authUserId = Auth::user()->id;

        $modulesByAuthUser = Student::select('students.user_id', 'students.formation_id as formation_id', 'formations.name as formation_name','formation_details.module_id as module_id','modules.name as module_name')
        ->leftjoin('formation_details', 'formation_details.formation_id', 'students.formation_id')
        ->leftjoin('formations', 'formations.id', 'students.formation_id')
        ->leftjoin('modules', 'modules.id', 'formation_details.module_id')
        ->where('students.user_id', $authUserId)
        ->paginate(25);

        return Response::json($modulesByAuthUser);
    }

    public function getSkillsByAuthUser()
    {
        $authUserId = Auth::user()->id;

        $skillsByAuthUser = Progression::select('progressions.id as progresson_id', 'progressions.student_id as student_id','users.firstname', 'users.lastname', 'progressions.skill_id', 'skills.name', 'skills.module_id', 'modules.name')
        ->leftjoin('users', 'users.id', 'progressions.student_id')
        ->leftjoin('skills', 'skills.id', 'progressions.skill_id')
        ->leftjoin('modules', 'modules.id', 'skills.module_id')
        ->paginate(25);

        return Response::json($skillsByAuthUser);
    }
}
