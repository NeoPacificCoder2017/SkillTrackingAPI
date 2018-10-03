<?php

namespace App\Http\Controllers;
// import des resources
use App\Http\Resources\Student as StudentR;

// import des model
use App\Student;
use App\Formation;
use App\User;
use App\Skill;
use App\Progression;


use Validator;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{

    /**
     * Affiche le profil d'un étudiant
     */

    public function getStudentProfil()
    {
        $user = User::select('users.id as user_id', 'students.id as student_id','users.avatar','users.lastname', 'users.firstname', 'users.email', 'users.phone_number', 'users.birthday_date', 'users.gender', 'businesses.id as business_id', 'businesses.name as business_name')
            ->join('students', 'students.user_id', 'users.id')
            ->join('student_businesses', 'student_businesses.student_id', 'students.id')
            ->join('businesses', 'businesses.id', 'student_businesses.business_id')
            ->where('users.id', Auth::user()->id)
            ->get();
            return response::json($user);
    }
    public function getStudentProfilByUserId($userId)
    {
        $user = User::select('users.id as user_id', 'students.id as student_id','users.avatar','users.lastname', 'users.firstname', 'users.email', 'users.phone_number', 'users.birthday_date', 'users.gender', 'businesses.id as business_id', 'businesses.name as business_name')
            ->leftjoin('students', 'students.user_id', 'users.id')
            ->leftjoin('student_businesses', 'student_businesses.student_id', 'students.id')
            ->leftjoin('businesses', 'businesses.id', 'student_businesses.business_id')
            ->where('users.id', $userId)
            ->get();
            return response::json($user);
    }

    public function getStudentProfilForAdmin()
    {
        $user = User::select('users.id as user_id', 'students.id as student_id','users.avatar','users.lastname', 'users.firstname', 'users.email', 'users.phone_number', 'users.birthday_date', 'users.gender', 'businesses.id as business_id', 'businesses.name as business_name')
            ->leftjoin('students', 'students.user_id', 'users.id')
            ->leftjoin('student_businesses', 'student_businesses.student_id', 'students.id')
            ->leftjoin('businesses', 'businesses.id', 'student_businesses.business_id')
            ->get();
            return response::json($user);
    }

    /**
     * Affiche la liste d'étudiant
     */
    public function all(){
        $authUserTypeId = Auth::user()->user_type_id;
        $authUserId = Auth::user()->id;

        if($authUserTypeId == 1):
            $Students = Student::select('formations.id as formation_id','formations.name as formation_name','users.id as user_id','users.firstname as user_name')
            ->leftjoin('formations','formations.id','=','students.formation_id')
            ->leftjoin('users','users.id','=','students.user_id')
            ->paginate(3);
            return Response::json($Students);
        else:
            return Response::json(['error'=>'acces non autoriser']);
        endif;
    }

    /**
     * Affiche l'étudiant séléctionner
     */
    public function show($StudentId)
    {
        $Student = Student::select('id', 'formation_id','user_id')
            ->where('id', $StudentId)
            ->get()->first();
        return Response::json($Student);
    }

    /**
     * Supprime un étudiant
     */
    public function destroy($StudentId)
    {
        $student = Student::findOrFail($StudentId);
        if($student->delete()):
            return new StudentR($student);
        endif;
    }


    public function store(Request $request)
    {
        $authUserId = Auth::user()->id;

        //si la méthode est un put, on effectue la modification
        if($request->isMethod('put')):
          $student =
            Student::where([
              [ 'id', '=', $request->student_id],
            ])->get()->first();

          if(!empty($student)):
            $student->id = $request->input('student_id');
            $student->formation_id = $request->input('formation_id');
            $student->user_id = $request->input('user_id');

            // dd($student);

            if($student->save()):
              return new StudentR($student);
            endif;
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;

        //fin de la modification, ici on crée un nouveau commentaire
        else:
          $input = $request->all();
          $student = Student::create($input);

          return new StudentR($student);
        endif;
    }

    public function getStudentSkillsByModule($userId, $formationId)
    {
        $userAuthorized = [1, 2];
        if(in_array(Auth::user()->user_type_id, $userAuthorized)):
            $formation = Formation::find($formationId);
            $user = User::find($userId);
            $student = Student::where([['user_id',$userId],['formation_id',$formationId],['active',1]])->first();
            $skills = Skill::getSkillsByFormationIdAndTeacherId($formationId);
            
            $studentDatas = [];
            $moduleId = 0;
            $i = -1;
            
            $studentDatas['student'] = [
                'user_id'=> $user->id,
                'user_firstname'=> $user->firstname,
                'user_lastname'=> $user->lastname,
                'user_avatar'=> $user->avatar,
            ];

            foreach ($skills as $key=>$skill):

                if($moduleId != $skill['module_id']):
                    $i++;
                    $moduleId = $skill['module_id'];
                    $studentDatas['modules'][$i] = ['id'=>$skill['module_id'], 'name'=>$skill['module_name']];
                    $studentDatas['modules'][$i]['progression'] = ['teacher'=>0, 'student'=>0];
                    $studentDatas['modules'][$i]['totalSkills'] =0;
                endif;

                $progression = Progression::where([
                    ['progressions.skill_id', $skill['skill_id']],
                    ['progressions.student_id', $student->id]
                ])->first();

                $studentDatas['modules'][$i]['skills'][] = [
                    'id'=>$skill['skill_id'],
                    'name'=>$skill['skill_name'],
                    'progression'=> [
                        'student_progression_id' => $progression->id,
                        'student_validation' => $progression->student_validation,
                        'student_validation_date' => $progression->student_validation_date,
                        'teacher_validation' => $progression->teacher_validation,
                        'teacher_validation_date' => $progression->teacher_validation_date,
                    ],
                    'teacher' => [
                        'lastname' => $skill['teacher_lastname'],
                        'firstname' => $skill['teacher_firstname'],
                    ]
                ];
                $studentDatas['modules'][$i]['totalSkills']++;
                
                if($progression->student_validation) $studentDatas['modules'][$i]['progression']['student']++;
                if($progression->teacher_validation) $studentDatas['modules'][$i]['progression']['teacher']++;
            endforeach;

            return response::json($studentDatas);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;

    }

    public function getSkillsAuthUser()
    {
        $formationData = User::getMyCurrentFormation();

        $student = Student::where([['user_id',Auth::user()->id],['formation_id',$formationData->formation_id],['active',1]])->first();
        
        $skillsData = Skill::getSkillsByFormationId($formationData->formation_id);

        $studentDatas = [];
        $moduleId = 0;
        $i = -1;

        foreach ($skillsData as $key=>$skill):

            
            // $formations = Formation::select('formations.name', 'formations.id')->where([
            //     ['id', $formationData->formation_id],
            // ])
            // ->groupBy('formations.id')
            // ->get();
            // $studentDatas[$key]['formation'] = $formations;

            if($moduleId != $skill['module_id']):
                $i++;
                $moduleId = $skill['module_id'];
                $studentDatas[$i]['module'] = ['id'=>$skill['module_id'], 'name'=>$skill['module_name']];
                $studentDatas[$i]['module']['progression'] = ['teacher'=>0, 'student'=>0];
                $studentDatas[$i]['module']['totalSkills'] =0;
            endif;

            $progression = Progression::where([
                ['progressions.skill_id', $skill['skill_id']],
                ['progressions.student_id', $student->id]
            ])->first();

            
            $studentDatas[$i]['module']['skills'][] = [
                'id'=>$skill['skill_id'],
                'name'=>$skill['skill_name'],
                'progression'=> [
                    'student_progression_id' => $progression->id,
                    'student_validation' => $progression->student_validation,
                    'student_validation_date' => $progression->student_validation_date,
                    'teacher_validation' => $progression->teacher_validation,
                    'teacher_validation_date' => $progression->teacher_validation_date,
                ]
            ];
            $studentDatas[$i]['module']['totalSkills']++;
            
                if($progression->student_validation) $studentDatas[$i]['module']['progression']['student']++;
                if($progression->teacher_validation) $studentDatas[$i]['module']['progression']['teacher']++;
            
        endforeach;

        return response::json($studentDatas);

    }

    public function getAllStudentsNotInFormation($formationId)
    {
        $users = User::select('users.*')
            // ->join('students', 'students.user_id', 'users.id')
            ->where('user_type_id', 3)
            ->get()->toArray();
            
            foreach ($users as $key=>$user):
                $isIn = Student::where('user_id', $user['id'])->where('formation_id', $formationId)->count();
                if($isIn){
                    unset($users[$key]); 
                }
            endforeach;
            $users = array_values($users);
            return Response::json($users);
    }
    // je suis un formateur, j'ai l'ensemble de mes formations, je veux pouvoir afficher les modules que je dispense pour chaque formation
    /**
     * Get all the skills by modules
     * @param $formationId int Formation Id
     * @return json of Skills given formation sorted by modules
     */

    public function getSkillsByFormation($formationId)
    {
        $userId = Auth::user()->id;
        $formation = Formation::find($formationId);
        $user = User::find($userId);
        $student = Student::where([['user_id',$userId],['formation_id',$formationId],['active',1]])->first();
        $skillsData = Skill::getSkillsByFormationId($formationId);

        $studentDatas = [];
        $moduleId = 0;
        $i = -1;

        foreach ($skillsData as $key=>$skill):

            if($moduleId != $skill['module_id']):
                $i++;
                $moduleId = $skill['module_id'];
                $studentDatas[$i]['module'] = ['id'=>$skill['module_id'], 'name'=>$skill['module_name']];
                $studentDatas[$i]['module']['progression'] = ['teacher'=>0, 'student'=>0];
                $studentDatas[$i]['module']['totalSkills'] =0;
            endif;

            $progression = Progression::where([
                ['progressions.skill_id', $skill['skill_id']],
                // ['progressions.student_id', $student->id]
            ])->first();

            $studentDatas[$i]['module']['skills'][] = [
                'id'=>$skill['skill_id'],
                'name'=>$skill['skill_name'],
                'progression'=> [
                    'student_progression_id' => $progression->id,
                    'student_validation' => $progression->student_validation,
                    'student_validation_date' => $progression->student_validation_date,
                    'teacher_validation' => $progression->teacher_validation,
                    'teacher_validation_date' => $progression->teacher_validation_date,
                ]
            ];
            $studentDatas[$i]['module']['totalSkills']++;
            
            if($progression->student_validation) $studentDatas[$i]['module']['progression']['student']++;
            if($progression->teacher_validation) $studentDatas[$i]['module']['progression']['teacher']++;
        endforeach;

        return response::json($studentDatas);

    }

    public function getAllFormations()
    {
        if(Auth::user()->user_type_id == 3):
            $formationData = [];
            $moduleId = 0;
            $i = -1;

            $formationData = Student::select('students.id as student_id', 'formations.name as formation_name', 'formations.id as formation_id','formations.start_at as formation_start_at', 'formations.end_at as formation_end_at' )
            ->join('formations', 'formations.id', 'students.formation_id')
            ->where('students.active', 1)
            ->orderBy('students.id', 'desc')
            ->get()->toArray();

            return Response::json($formationData);
        endif;
    }

    public function getStudentsFormation($formationId)
    {
        $formationData = Student::select(
            'students.user_id as student_id',
            'users.id as user_id',
            'users.lastname as lastname',
            'users.firstname as firstname'
        )
        ->join('users', 'users.id', '=', 'students.user_id')
        ->join('formations', 'formations.id', '=', 'students.formation_id')
        ->where([
            ['students.active', '=', '1'],
            ['formations.id', '=', $formationId],
        ])->get()->toArray();

        $studentDatas = [];
        $moduleId = 0;
        $i = -1;

        foreach($formationData as $key=>$skill):
            dd($skill);
            if($moduleId != $skill['module_id']):
                $i++;
                $moduleId = $skill['module_id'];
                $studentDatas[$i]['module'] = ['id'=>$skill['module_id'], 'name'=>$skill['module_name']];
                $studentDatas[$i]['module']['progression'] = ['teacher'=>0, 'student'=>0];
                $studentDatas[$i]['module']['totalSkills'] =0;
            endif;
        endforeach;
        return Response::json($formationData);
    }


    public function getStudentsByFormationId($formationId)
    {
        if(Auth::user()->user_type_id == 2):
            $users = Student::
                select('users.*','students.id as student_id')
                ->join('users','users.id','students.user_id')
                ->where([
                    ['students.formation_id',$formationId]
                ])->get()->toArray();

            foreach($users as $key=>$user):
                $users[$key]['progression'] = Progression::getProgressionsByStudentIdAndByFormationId($formationId, $user['student_id']);
            endforeach;

            return Response::json($users);
        endif;

        return Response::json("Vous n'avez pas les droites nécessaires");
    }

    /**
     * Create a new student
     */
    public function createStudent(Request $request)
    {
        if(Auth::user()->user_type_id == 1):
            $validator = Validator::make($request->all(), [
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
                'avatar' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }

            if($request->hasfile('avatar')):
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
            $file->move('uploads/images/', $filename);
            endif;

            $input = $request->all();
            $input['avatar'] = $filename;
            $input['user_type_id'] = 3;
            $input['password'] = bcrypt($input['password']);

            $user = User::create($input);

            $studentData = [
                'user_id' => $user->id,
                'formation_id' => $input['formation_id'],
                'active' => 1,
            ];

            $studentCreate = Student::create($studentData);


            $student = Student::select('*')->where('user_id', $user->id)->where('active', 1)->get()->first();
            // dd($student);

            $success['token'] =  $user->createToken('Laravel')->accessToken;
            $success['id'] =  $user->id;
            $success['lastname'] =  $user->lastname;
            $success['firstname'] =  $user->firstname;
            $success['email'] =  $user->email;
            $success['gender'] =  $user->gender;
            $success['user_type_id'] =  $user->user_type_id;
            $success['student_id'] =  $student['user_id'];
            // dd($success);
            return Response::json($success);
        else:
            return response::json(["error"=>"vous n'avez pas les droits"]);
        endif;
    }
}
