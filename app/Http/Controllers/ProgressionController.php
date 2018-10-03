<?php

namespace App\Http\Controllers;

use App\Progression;
use App\Http\Resources\Progression as ProgressionR;
use App\Student;
use App\Skill;
use App\Module;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ProgressionController extends Controller
{
    /**
     * getTotalSynthesisOfProgression
     */

    public function getTotalProgressions()
    {
        $progressions = Progression::count('id');
        return response::json($progressions);
    }

    public function skillsByModule($moduleId)
    {
        $modules = Module::select('modules.id','modules.name as module_name')
            ->where('modules.id', $moduleId)
            ->get();
        foreach($modules as $key=>$module):
            // dd($modules);
            $skills = Skill::select('skills.*')
                ->join('modules', 'modules.id', 'skills.module_id')
                ->where('module_id', $module->id)->get();
           
            
            $modules[$key]->skills = $skills;
        endforeach;
        return response::json($modules);
    }
    /**
     * Get progressions data by skills
     * @return Response json
     */
    public function progressionsBySkills($moduleId)
    {
        $user = Auth::user();
        if($user->user_type_id == 1):
            $skills = Skill::select('skills.id as id','skills.name as name','module_id as module_id', 'modules.name as module_name')
                ->join('modules', 'modules.id', 'skills.module_id')
                ->where('module_id', $moduleId)
                ->get();

            foreach ($skills as $key=>$skill):
                $skillsValidatedByTeachers = Progression::select('progressions.id')
                    ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('skills.id', $skill->id)
                    ->where('teacher_validation', 1)
                ->get();
                $skillsValidatedByStudents = Progression::select('progressions.id')
                    ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('skills.id', $skill->id)
                    ->where('student_validation', 1)
                ->get();
                $skillsToValidate = Progression::select('progressions.id')
                    ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('skills.id', $skill->id)
                ->get();

                $skills[$key]->validated_by_teacher = $skillsValidatedByTeachers->count();
                $skills[$key]->validated_by_student = $skillsValidatedByStudents->count();
                $skills[$key]->toValidate = $skillsToValidate->count();

            endforeach;
            return response::json($skills);
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;
    }

    public function getProgressionForAdminByStudentId($studentId)
    {
        if(Auth::user()->user_type_id == 1):
            $students = Student::select('users.lastname', 'users.firstname')
                ->join('users', 'users.id', 'students.user_id')
                ->where('students.user_id', $studentId)->get();
                // dd($students);

            $user = Student::select('users.lastname', 'users.firstname', 'students.id as student_id')
            ->join('users', 'users.id', 'students.user_id')
            ->where('students.user_id', $studentId)->get()->first();
            // dd($user);
            
            foreach($students as $key=>$student):
                $skillsTotal = Progression::select('progressions.skill_id')->where('progressions.student_id', $studentId)->get();
                $skillsValidatedByStudent = Progression::select('progressions.skill_id', 'skills.name')
                    ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('progressions.student_validation', 1)
                    ->where('progressions.student_id', $user->student_id)
                    ->get();
                $skillsValidatedByTeachers = Progression::select('progressions.skill_id', 'skills.name')
                    ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('progressions.teacher_validation', 1)
                    ->where('progressions.student_id', $user->student_id)
                    ->get();
                $skillsValidatedByTeachersAndStudent = Progression::select('progressions.skill_id', 'skills.name')
                ->join('skills', 'skills.id', 'progressions.skill_id')
                    ->where('progressions.student_validation', 1)
                    ->where('progressions.teacher_validation', 1)
                ->where('progressions.student_id', $user->student_id)
                ->get();
                
                $students[$key]->countOfSkillsTotal = $skillsTotal->count();
                $students[$key]->countOfSkillsValidatedByStudent = $skillsValidatedByStudent->count();
                $students[$key]->countOfSkillsValidatedByTeachers = $skillsValidatedByTeachers->count();
                $students[$key]->skillsValidatedByTeachersAndStudent = $skillsValidatedByTeachersAndStudent;
            endforeach;
            return response::json($students);
        endif;
    }

    /**
     * Update mandatory
     */
    public function isMandatoryUpdate(Request $request)
    {
        $user = Auth::user();
        if($user->user_type_id == 1):
            $input = $request->all();
            $skill = Skill::find($input['skill_id']);
            $skill->is_mandatory = $input['isMandatory'];
            $skill->save();

            return Response::json('succès');
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;
    }

    public function all()
    {
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user();

        if($authUserTypeId == 1):
            $progressions = Progression::select('progressions.id as progression_id', 'skills.name as skill_name', 'student_validation', 'teacher_validation', 'users.lastname as student_name')
            ->leftjoin('users','users.id','=','progressions.student_id')
            ->leftjoin('skills','skills.id','=','progressions.skill_id')
            ->paginate(25);

            return Response::json($progressions);
        else:
            return Response::json(['error'=>'accès non authorisé']);
        endif;
    }

    public function show($progressionId)
    {
        $progressionId  = Progression::select('progressions.id as progression_id', 'skills.name as skill_name', 'student_validation', 'teacher_validation', 'users.lastname as student_name')
        ->leftjoin('users','users.id','=','progressions.student_id')
        ->leftjoin('skills','skills.id','=','progressions.skill_id')
        ->get()->first();

        return Response::json($progressionId);
    }

    public function destroy($progressionId)
    {
        $progression = Progression::findOrFail($progressionId);

        if($progression->delete()):
            return new ProgressionR($progression);
        endif;
    }

    public function studentValidation(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
            $progression =
                Progression::where([
                    [ 'id', '=', $request->progression_id],
                ])->get()->first();

            if(!empty($progression)):
                $progression->id = $request->input('progression_id');
                $progression->student_id = $request->input('student_id');
                $progression->skill_id = $request->input('skill_id');
                $progression->student_validation = $request->input('student_validation');
                $progression->teacher_validation = $request->input('teacher_validation');

                // dd($formation);

                if($progression->save()):
                    return new ProgressionR($progression);
                endif;

            else:
                return Response::json(['error'=>'Vous ne pouvez pas modifier de progression']);
            endif;

        endif;
    }

    public function store(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
            $progression =
                Progression::where([
                    [ 'id', '=', $request->progression_id],
                ])->get()->first();

            if(!empty($progression)):
                $progression->id = $request->input('progression_id');
                $progression->student_id = $request->input('student_id');
                $progression->skill_id = $request->input('skill_id');
                $progression->student_validation = $request->input('student_validation');
                $progression->teacher_validation = $request->input('teacher_validation');

                // dd($formation);

                if($progression->save()):
                    return new ProgressionR($progression);
                endif;

            else:
                return Response::json(['error'=>'Vous ne pouvez pas modifier de progression']);
            endif;

        //fin de la modification, ici on crée un nouveau commentaire
        else:
            $input = $request->all();
            $progression = Progression::create($input);
            return new ProgressionR($progression);
        endif;
    }
    /**
     * Update all validations
     */

    public function updateAllTeacherValidation(Request $request)
    {
        $user = Auth::user();
        if($user->user_type_id == 2):
            $input = $request->all();
            $values=array(
                'teacher_validation' => $input['teacher_validation'],
                'teacher_validation_date' => date('Y-m-d H:m:s'),

            );
            $progression = DB::table('progressions')->select('progressions.teacher_validation', 'progressions.teacher_validation_date','progressions.updated_at as progressions_updated_at')
                ->join('skills', 'skills.id','progressions.skill_id')
                ->join('formation_details', 'formation_details.module_id', 'skills.module_id')
                ->where('formation_details.module_id', $input['module_id'])
                ->where('progressions.student_id', $input['student_id'])
                ->update($values);

            return Response::json('succès');
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;

    }

    public function updateAllStudentValidation(Request $request)
    {
        $user = Auth::user();
        if($user->user_type_id == 2):
            $input = $request->all();
            $values=array(
                'student_validation' => $input['student_validation'],
                'student_validation_date' => date('Y-m-d H:m:s'),

            );
            $progression = DB::table('progressions')->select('progressions.student_validation', 'progressions.student_validation_date','progressions.updated_at as progressions_updated_at')
                ->join('skills', 'skills.id','progressions.skill_id')
                ->join('formation_details', 'formation_details.module_id', 'skills.module_id')
                ->where('formation_details.module_id', $input['module_id'])
                ->where('progressions.student_id', $input['student_id'])
                ->update($values);

            return Response::json('succès');
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;

    }
    public function updateStudentValidation(Request $request)
    {
        $user = Auth::user();
        if($user->user_type_id == 3):
            $input = $request->all();
            $progression = Progression::find($input['progression_id']);
            $progression->student_validation = $input['student_validation'];
            $progression->student_validation_date = date('Y-m-d H:m:s');
            $progression->save();

            return Response::json('succès');
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;
    }

    public function updateTeacherValidation(Request $request)
    {
        $user = Auth::user();
        if($user->user_type_id == 2):
            $input = $request->all();
            $progression = Progression::find($input['progression_id']);
            $progression->teacher_validation = $input['teacher_validation'];
            $progression->teacher_validation_date = date('Y-m-d H:m:s');
            $progression->save();

            return Response::json('succès');
        else:
            return Response::json("Vous n'avez pas les droits");
        endif;
    }

    public function addProgression($studentId, $formationId)
    {
        // dd($formationId);
       
        Progression::createProgressionForStudentOfFormation($studentId, $formationId);

    }

}
