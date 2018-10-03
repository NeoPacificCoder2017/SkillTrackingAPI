<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name', 'module_id', 'is_mandatory'
    ];

    public static function getSkillsByFormationId($formationId, $toArray = 1) {
        $skillsDatas = Skill::select(
            'skills.id as skill_id',
            'skills.name as skill_name',
            'skills.module_id as module_id',
            'modules.name as module_name'
        )
        ->join('modules', 'modules.id', 'skills.module_id')
        ->join('formation_details', 'formation_details.module_id', 'modules.id')
        ->where('formation_details.formation_id', $formationId)
        ->get();

        return ($toArray)?$skillsDatas->toArray():$skillsDatas;
    }

    public static function getSkillsByFormationIdAndTeacherId($formationId, $toArray = 1) {
        $skillsDatas = Skill::select(
            'skills.id as skill_id',
            'skills.name as skill_name',
            'skills.module_id as module_id',
            'modules.name as module_name',
            'users.firstname as teacher_firstname',
            'users.lastname as teacher_lastname'
        )
        ->join('modules', 'modules.id', 'skills.module_id')
        ->join('formation_details', 'formation_details.module_id', 'modules.id')
        ->join('users', 'users.id', 'formation_details.teacher_id')
        ->where('formation_details.formation_id', $formationId);
        if(Auth::user()->user_type_id == 2)  $skillsDatas = $skillsDatas->where('formation_details.teacher_id', Auth::user()->id);


        $skillsDatas = $skillsDatas->get();
        return ($toArray)?$skillsDatas->toArray():$skillsDatas;
    }

    public static function getSkillsByModuleId($moduleId, $toArray = 1) {
        $skillsDatas = Skill::where('module_id', $moduleId)->get();

        return ($toArray)?$skillsData->toArray():$skillsDatas;
    }
}
