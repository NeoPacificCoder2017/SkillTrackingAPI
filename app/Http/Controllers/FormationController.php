<?php

namespace App\Http\Controllers;

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

use Carbon;      
class FormationController extends Controller
{
    public function getStudentsFormation()
    {
        
        $auth = Auth::user();
        // Check if the logged user is a teacher
        if($auth->user_type_id == 3):
            $myFormations = Formation::select('formations.*')
            ->join('students', 'students.formation_id', 'formations.id')
            ->join('users', 'users.id', 'students.user_id')
            ->where('students.user_id', $auth->id)->get()
                ->toArray();
            
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
                endforeach;
                
            return Response::json($myFormations);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }
    
    public function all()
    {
        if(Auth::user()->user_type_id == 1):
            $formations = Formation::select('id', 'name', 'start_at', 'end_at', 'logo')->paginate(25);
            return Response::json($formations);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function show($formationId)
    {
            $formation = Formation::select('id', 'name', 'start_at', 'end_at', 'logo')
                ->where('id', $formationId)
                ->get()->first();
            return Response::json($formation);
   
    }
    /**
     * Création et modification d'une formation 
     * @return Response
     */
    public function store(Request $request)
    {

        if(Auth::user()->user_type_id == 1):
            //si la méthode est un put, on effectue la modification
            if($request->isMethod('put')):
                $formation = 
                Formation::where([[ 'id', '=', $request->formation_id]])->get()->first();
                    if($request->hasfile('logo')):
                        $file = $request->file('logo');
                        $extension = $file->getClientOriginalExtension(); // getting image extension
                        $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
                        $file->move('uploads/logos/', $filename);
                    endif;
                        
                    if(!empty($formation)):
                        $formation->id = $request->input('formation_id');
                        $formation->name = $request->input('name');
                        $formation->start_at = $request->input('start_at');
                        $formation->end_at = $request->input('end_at');
                        $formation->logo = $filename;

                        if($formation->save()):
                            return new FormationR($formation);
                        endif;
                    endif;
                
                //fin de la modification, ici on crée un nouveau commentaire
            else:
                $input = $request->all();
                
                if($request->hasfile('logo')):
                    $file = $request->file('logo');
                    $extension = $file->getClientOriginalExtension(); // getting image extension
                    $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
                    $file->move('uploads/logos/', $filename);
                endif;

                $input['logo'] = $filename;

                $formation = Formation::create($input);

                return new FormationR($formation);
            endif;
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function editFormation(Request $request, $formationId)
    {
        $formation = Formation::where('id', $formationId)->get()->first();
        if($request->hasfile('logo')):
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
            $file->move('uploads/logos/', $filename);
        endif;
                        
        if(!empty($formation)):
            $formation->name = $request->input('name');
            $formation->start_at = $request->input('start_at');
            $formation->end_at = $request->input('end_at');
            $formation->logo = $filename;

            if($formation->save()):
                return new FormationR($formation);
            endif;
        endif;
    }


    /**
     * Suppression d'une formation, par son id
     */
    public function destroy($formationId)
    {
        if(Auth::user()->user_type_id == 1):
            $formation = Formation::findOrFail($formationId);
            if($formation->delete()):
                return new FormationR($formation);
            endif;
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    /**
     * Get all formations of the logged teacher.
     *
     * @return Response
     */
    public function getFormationsOfTeacher() 
    {
        $teacher = Auth::user();
        // Check if the logged user is a teacher
        if($teacher->user_type_id == 2):
            $myFormations = FormationDetail::
                select(DB::raw('DISTINCT(formation_details.formation_id) as id, 
                    formations.name, 
                    formations.logo, 
                    formations.start_at, 
                    formations.end_at'))
                ->join('formations','formations.id','=','formation_details.formation_id')
                ->where('formation_details.teacher_id',$teacher->id)
                ->get();
                foreach($myFormations as $key=> $myFormation):
                    $module = FormationDetail::where('teacher_id', Auth::user()->id)
                        ->select('modules.name', 'modules.id')
                        ->join('modules', 'modules.id', 'formation_details.module_id')
                        ->get();

                    $user = User::select('users.id')
                        ->join('students', 'students.user_id', 'users.id')
                        ->where('students.formation_id',$myFormation->id )
                        ->get();

                    $totalSkills = Progression::select('progressions.id')
                        ->get();

                    $myFormations[$key]['modules'] = $module;
                    $myFormations[$key]['total_students'] = $user->count();
                endforeach;

            return Response::json($myFormations);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    /**
     * Get all formations of the logged teacher.
     *
     * @return Response
     */
    
    public function getAllFormationsForAdmin() 
    {
        $teacher = Auth::user();
        // Check if the logged user is a teacher
        if($teacher->user_type_id == 1):
            $myFormations = Formation::all()->toArray();
            
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
                
            return Response::json($myFormations);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function getTeachersByFormationId($formationId)
    {
        if(Auth::user()->user_type_id == 1):
            $teachersOfFormation = User::select('formation_details.teacher_id as id', 'users.lastname as lastname', 'users.firstname as firstname', 'users.avatar as avatar')
            ->join('formation_details', 'formation_details.teacher_id', 'users.id')
            ->groupBy('formation_details.teacher_id')
            ->where('formation_details.formation_id', $formationId)
            ->get();
            

            foreach($teachersOfFormation as $key=>$teacher):
                $modules = Module::select('formation_details.module_id as id', 'modules.name as name')
                ->join('formation_details', 'formation_details.module_id', 'modules.id')
                ->groupBy('formation_details.module_id')
                ->where('formation_details.formation_id', $formationId)
                ->where('formation_details.teacher_id', $teacher['id'])
                ->get();
    
                $teachersOfFormation[$key]['modules'] = $modules;
    
            endforeach;
            return Response::json($teachersOfFormation);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;

    }

    public function getStudentsByFormationId($formationId)
    {
        if((Auth::user()->user_type_id == 1) || (Auth::user()->user_type_id == 3) ):

            $students = User::select('users.id as user_id', 'users.firstname', 'users.lastname', 'users.avatar')
            ->join('students', 'students.user_id', 'users.id')
            ->where('students.formation_id', $formationId)
            ->get();

            foreach($students as $key=> $student):

                $skills = Progression::select('progressions.skill_id')
                ->join('students', 'students.id', 'progressions.student_id')
                ->groupBy('progressions.skill_id')
                ->where('students.formation_id', $formationId)
                ->where('students.user_id', $student->user_id)
                ->get();


                $progressionsValidatedStudent = Progression::join('students', 'students.id', 'progressions.student_id')
                ->where('students.formation_id', $formationId)
                ->where('students.user_id', $student->user_id)
                ->where('progressions.student_validation', '=', 1)
                ->get();

                $progressionsValidatedteacher = Progression::join('students', 'students.id', 'progressions.student_id')
                ->where('students.formation_id', $formationId)
                ->where('students.user_id', $student->user_id)
                ->where('progressions.teacher_validation', '=', 1)
                ->get();

                $students[$key]['total_student_skills'] = $skills->count();
                $students[$key]['progressions_student_validated'] = $progressionsValidatedStudent->count();
                $students[$key]['progressions_teacher_validated'] = $progressionsValidatedteacher->count();
            endforeach;
            return Response::json($students);

        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;

    }

    public function getModulesByFormationId($formationId)
    {
        if(Auth::user()->user_type_id == 1):
            
            $modules = Module::select('formation_details.module_id as id', 'modules.name')
            ->join('formation_details', 'formation_details.module_id', 'modules.id')
            ->groupBy('formation_details.module_id')
            ->where('formation_details.formation_id', $formationId)
            ->get();

            foreach($modules as $key=>$module):

                $teacher = User::select('users.id as teacher_id', 'users.lastname', 'users.firstname','users.avatar')
                    ->join('formation_details', 'formation_details.teacher_id', 'users.id')
                    ->where('formation_details.module_id', $module->id )
                    ->get()->first();

                $skills = Skill::where('skills.module_id', '=', $module->id)
                ->get();

                $progressionsValidatedStudent = Progression::
                join('skills','skills.id', 'progressions.skill_id')
                ->where('skills.module_id', '=', $module->id)
                ->where('progressions.student_validation', '=', 1)
                ->get();

                $progressionsValidatedteacher = Progression::
                join('skills','skills.id', 'progressions.skill_id')
                ->where('skills.module_id', '=', $module->id)
                ->where('progressions.teacher_validation', '=', 1)
                ->get();

                $totalProgression = Progression::
                join('skills','skills.id', 'progressions.skill_id')
                ->where('skills.module_id', '=', $module->id)
                ->get();


                $modules[$key]['total_skills_validated_by_student'] = $progressionsValidatedStudent->count();
                $modules[$key]['total_skills_validated_by_teacher'] = $progressionsValidatedteacher->count();
                $modules[$key]['total_skills'] = $totalProgression->count();
                $modules[$key]['teacher'] = $teacher;
                $modules[$key]['skills'] = $skills;
                
            endforeach;
            
            return Response::json($modules);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    /**
     * Get total formations
     */
    public function getTotalFormations()
    {
        $formations = Formation::select('id')->get()->count();
        return response::json($formations);
    }

    /**
     * Get total students
     */
    public function getTotalStudents()
    {
        $students = User::select('id')->where('user_type_id', 3)->get()->count();
        return response::json($students);
    }

    /**
     * Get total teachers
     */
    public function getTotalTeacher()
    {
        $teachers = User::select('id')->where('user_type_id', 2)->get()->count();
        return response::json($teachers);
    }

    /**
     * Get total modules
     */
    public function getTotalModules()
    {
        $modules = Module::select('id')->get()->count();
        return response::json($modules);
    }

    /**
     * Get Total Skills
     */
    public function getTotalSkills()
    {
        $skills = Skill::select('id')->get()->count();
        return response::json($skills);
    }

    /**
     * Get Total Skills Validated By Students
     */
    public function getTotalSkillsValidatedByStudents()
    {
        $skillsValidatedByStudents = Progression::select('id')->where('student_validation', 1)->get()->count();
        return response::json($skillsValidatedByStudents);
    }

    /**
     * Get Total Skills Validated By Teachers
     */
    public function getTotalSkillsValidatedByTeachers()
    {
        $skillsValidatedByTeachers = Progression::select('id')->where('teacher_validation', 1)->get()->count();
        return response::json($skillsValidatedByTeachers);
    }

    

    /**
     * 
     */
    public function getActiveFormation ()
    {
        $mytime = Carbon\Carbon::now();
        $myFormations = Formation::select('id', 'name','start_at', 'end_at', 'logo')
        ->where([
            ['start_at', '<', $mytime],
            ['end_at', '>', $mytime],
        ])
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
