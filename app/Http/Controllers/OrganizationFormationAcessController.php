<?php

namespace App\Http\Controllers;

use App\OrganizationFormationAcess;
use App\Formation;
use App\Skill;
use App\User;
use App\Module;
use App\Progression;
use App\FormationDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\Formation as FormationR;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Input;             
use Illuminate\Support\Facades\Response;

class OrganizationFormationAcessController extends Controller
{
    public function getFormationForOrganization()
    {
        $myFormations = Formation::select('formations.id', 'formations.name','formations.start_at', 'formations.end_at', 'formations.logo')
        ->join('organization_formation_acesses', 'organization_formation_acesses.formation_id', 'formations.id')
        ->where('organization_formation_acesses.user_id', Auth::user()->id)
        ->get()->toArray();
            
        foreach($myFormations as $key=>$myFormation):
            $students = User::join('students', 'students.user_id', 'users.id')
            ->where('students.formation_id', $myFormation['id'])
            ->get();

            $progressions = Progression::where('students.formation_id', $myFormation['id'])
            ->join('students', 'students.id', 'progressions.student_id')
            ->get();

            $progressionsValidatedStudent = Progression::join('students', 'students.id', 'progressions.student_id')
            ->where('students.formation_id', $myFormation['id'])
            ->where('progressions.student_validation', '=', 1)
            ->get();

            $progressionsValidatedteacher = Progression::join('students', 'students.id', 'progressions.student_id')
            ->where('students.formation_id', $myFormation['id'])
            ->where('progressions.teacher_validation', '=', 1)
            ->get();

            $teachers = User::select('formation_details.teacher_id')
            ->join('formation_details', 'formation_details.teacher_id', 'users.id')
            ->groupBy('formation_details.teacher_id')
            ->where('formation_details.formation_id', $myFormation['id'])
            ->get();

            $modules = Module::select('formation_details.module_id')
            ->join('formation_details', 'formation_details.module_id', 'modules.id')
            ->groupBy('formation_details.module_id')
            ->where('formation_details.formation_id', $myFormation['id'])
            ->get();

            $skills = Progression::select('progressions.skill_id')
            ->join('students', 'students.id', 'progressions.student_id')
            ->groupBy('progressions.skill_id')
            ->where('students.formation_id', $myFormation['id'])
            ->get();


            $myFormations[$key]['total_students']= $students->count();
            $myFormations[$key]['total_teachers'] = $teachers->count();
            $myFormations[$key]['total_modules'] = $modules->count();
            $myFormations[$key]['total_skills'] = $skills->count();
            $myFormations[$key]['progressions_total_skills']= $progressions->count();
            $myFormations[$key]['progressions_student_validated'] = $progressionsValidatedStudent->count();
            $myFormations[$key]['progressions_teacher_validated'] = $progressionsValidatedteacher->count();
        endforeach;
        return response::json($myFormations);

    }
}
