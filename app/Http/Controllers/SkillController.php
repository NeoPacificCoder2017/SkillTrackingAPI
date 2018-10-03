<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Http\Resources\Skill as SkillR;
use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SkillController extends Controller
{
    public function all()
    {
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user();

        if($authUserTypeId == 1):
            $skills = Skill::select('skills.id as skill_id', 'skills.name as skill_name', 'modules.name as module_name', 'skills.is_mandatory as skill_is_mandatory')
            ->leftjoin('modules', 'modules.id', '=', 'skills.module_id')
            ->paginate(25);

            return Response::json($skills);
        else:
            return Response::json(['error' => 'accès non authorisé']);
        endif;
    }

    public function show($skillId)
    {
        $skillId = Skill::select('skills.id as skill_id', 'skills.name as skill_name', 'modules.name as module_name', 'skills.is_mandatory as skill_is_mandatory')
        ->leftjoin('modules', 'modules.id', '=', 'skills.module_id')
        ->get()->first();

        return Response::json($skillId);
    }

    public function destroy($skillId)
    {
        $skill = Skill::findOrFail($skillId);
        
        if($skill->delete()):
            return new SkillR($skill);
        endif;
    }

    public function store(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
            $skill = 
            Skill::where([
                [ 'id', '=', $request->skill_id],
            ])->get()->first();
    
            if(!empty($skill)):
                $skill->id = $request->input('skill_id');
                $skill->name = $request->input('name');
                $skill->module_id = $request->input('module_id');
                $skill->is_mandatory = $request->input('is_mandatory');
    
                // dd($skill);
    
                if($skill->save()):
                return new SkillR($skill);
                endif;
    
            else:
                return Response::json(['error'=>'Vous ne pouvez pas modifier de compétence']);
            endif;
        
        //fin de la modification, ici on crée une nouvelle compétence
        else:
            $input = $request->all();
            $skill = Skill::create($input);
            return new SkillR($skill);
        endif;
    }
}
