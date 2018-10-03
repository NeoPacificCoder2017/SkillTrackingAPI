<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserR;
use App\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Module;
use App\Admin;
use App\Formation;
use App\Student;
use App\FormationDetail;
use App\Progression;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\User as UserResource;
use Validator;
use Carbon;

class UserController extends Controller
{

    public $successStatus = 200;

    public function update($userid, Request $request)
    {
        if(Auth::user()->user_type_id == 1):
            $validator = Validator::make($request->all(), [
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
                'user_type_id' => 'required',
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
            $input['password'] = bcrypt($input['password']);

            $user = User::findOrFail($userid);
            $user->update($input);
            $student = Student::select('*')->where('user_id', $user->id)->where('active', 1)->get()->first();
            // dd($student);

            $success['token'] =  $user->createToken('Laravel')->accessToken;
            $success['id'] =  $user->id;
            $success['lastname'] =  $user->lastname;
            $success['firstname'] =  $user->firstname;
            $success['email'] =  $user->email;
            $success['gender'] =  $user->gender;
            $success['phone_number'] =  $user->phone_number;
            $success['birthday_date'] =  $user->birthday_date;
            $success['gender'] =  $user->gender;
            $success['user_type_id'] =  $user->user_type_id;
            $success['student_id'] =  $student['id'];
            // dd($success);
            return Response::json($success);
        else:
            return response::json(["error"=>"vous n'avez pas les droits"]);
        endif;
    }

    public function getFreeStudents() {
        $freeUsers = DB::table("users")->select('*')
            // ->join('students', 'students.user_id', 'users.id')
            ->whereNOTIn('id',function($query){
               $query->select('user_id')->from('students');
            })
            ->where('user_type_id', 3)
            // ->where('students.active', 0)
            ->get();

        $freeNonActive = DB::table('users')->select('*')
            ->join('students', 'students.user_id', 'users.id')
            ->where('students.active', 0)
            ->get();
        // return response::json($freeUsers);
        return response::json($freeNonActive);
             
    }

    public function login(){


        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $student = ($user->user_type_id == 3)?Student::select('*')->where('user_id', $user->id)->where('active', 1)->get()->first():null;


            $success['token'] =  $user->createToken('Laravel')->accessToken;
            $success['user_id'] =  $user->id;
            $success['lastname'] =  $user->lastname;
            $success['firstname'] =  $user->firstname;
            $success['phone_number'] =  $user->phone_number;
            $success['birthday_date'] =  $user->birthday_date;
            $success['email'] =  $user->email;
            $success['user_type_id'] =  $user->user_type_id;
            $success['avatar'] =  $user->avatar;
            $success['gender'] =  $user->gender;
            $success['student_id'] = ($student)?$student->id:0;
            $success['formation_id'] = ($student)?$student->formation_id:0;
            return Response::json($success);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        if(Auth::user()->user_type_id == 1):
            $validator = Validator::make($request->all(), [
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
                'user_type_id' => 'required',
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
            $input['password'] = bcrypt($input['password']);

            $user = User::create($input);
            $student = Student::select('*')->where('user_id', $user->id)->where('active', 1)->get()->first();
            // dd($student);

            $success['token'] =  $user->createToken('Laravel')->accessToken;
            $success['id'] =  $user->id;
            $success['lastname'] =  $user->lastname;
            $success['firstname'] =  $user->firstname;
            $success['email'] =  $user->email;
            $success['gender'] =  $user->gender;
            $success['phone_number'] =  $user->phone_number;
            $success['birthday_date'] =  $user->birthday_date;
            $success['gender'] =  $user->gender;
            $success['user_type_id'] =  $user->user_type_id;
            $success['student_id'] =  $student['user_id'];
            // dd($success);
            return Response::json($success);
        else:
            return response::json(["error"=>"vous n'avez pas les droits"]);
        endif;
    }

    public function fillStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'formation_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $studentData = [
            'user_id' => $input['user_id'],
            'formation_id' => $input['formation_id'],
            'active' => 1,
        ];

        $student = Student::create($studentData);
        Progression::createProgressionForStudentOfFormation($student->id, $student->formation_id);
        
        $success['id'] =  $student->id;
        $success['user_id'] =  $student->user_id;
        $success['formation_id'] =  $student->formation_id;

        return Response::json($success);
    }

    public function logout()
    {
        if(Auth::check()):
            Auth::user()->AauthAcessToken()->delete();

            return Response::json(["success"=>"Vous êtes bien déconnecté"]);
        endif;
    }

    public function all()
    {
        $users = User::select('id', 'lastname','firstname','email','user_type_id')->paginate(25);

        return Response::json($users);
    }

    public function listUsersAdmin()
    {
        if(Auth::user()->user_type_id == 1):
            $users = User::where('users.user_type_id', '=', 1)
            ->paginate(25);

            //On récupère les formations en cours que le formation a
            foreach($users as $key=>$user):
                $formations = Admin::where([
                        ['admins.user_id','=',$user->id]
                    ])
                    ->groupBy('admins.function')
                    ->pluck('admins.function')->toArray();

                $users[$key]->function = $formations;
            endforeach;

            return Response::json($users);
        endif;
    }

    public function listUsersTeacher()
    {
        if(Auth::user()->user_type_id == 1):
            $users = User::where('users.user_type_id', '=', 2)
            ->paginate(25);

            //On récupère les formations en cours que le formation a
            foreach($users as $key=>$user):
                $formationIds = FormationDetail::where([
                        ['formation_details.teacher_id','=',$user->id]
                    ])
                    ->groupBy('formation_details.formation_id')
                    ->pluck('formation_details.formation_id')->toArray();

                $formations = Formation::whereIn('id', $formationIds)
                    ->where([
                        ['formations.start_at','<=',date("Y-m-d H:i:s")],
                        ['formations.end_at','>',date("Y-m-d H:i:s")]
                    ])
                    ->get();
                $users[$key]->formations = $formations;
            endforeach;

            return Response::json($users);
        endif;
    }

    public function listUsersStudent()
    {
        if(Auth::user()->user_type_id == 1):
            $users = User::select('users.*')
            ->where('users.user_type_id', '=', 3)
            ->paginate(25);

            //On récupère les formations en cours que le formation a
            foreach($users as $key=>$user):
                $formationIds = Student::where([
                        ['students.user_id','=',$user->id]
                    ])
                    ->groupBy('students.formation_id')
                    ->pluck('students.formation_id')->toArray();

                $formations = Formation::whereIn('id', $formationIds)
                    ->where([
                        ['formations.start_at','<=',date("Y-m-d H:i:s")],
                        ['formations.end_at','>',date("Y-m-d H:i:s")]
                    ])
                    ->get();
                $users[$key]->formations = $formations;
            endforeach;

            return Response::json($users);
        endif;
    }

    public function forgotPassword(request $request)
    {
        $input = $request->all();
        $email = $input['email'];
        // dd($email);

        
        return 'Email was sent';
    }
    public function getTotalMales()
    {
        $users = User::select('id')->where('gender', 'LIKE', 'Homme')->get()->count();
        return response::json($users);
    }

    public function getTotalFemales()
    {
        $users = User::select('id')->where('gender', 'LIKE', 'Femme')->get()->count();
        return response::json($users);
    }

    public function getTotalFormationsHours()
    {
        $totalHours = Module::sum('total_hours');
        return response::json((int)$totalHours);
    }

    public function getTotalBusinesses()
    {
        $users = User::select('id')->where('user_type_id', 5)->get()->count();
        return response::json($users);
    }

    public function getTotalStudentsByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(`start_at`) as `start_at_year`'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $students = Student::join('formations', 'formations.id', 'students.formation_id')
                ->whereRaw('YEAR(`start_at`) <= '. $i)
                ->whereRaw('YEAR(`end_at`) >= '. $i)
                ->count('students.id');
            $datas[] = ['year'=>$i, 'total'=>$students];
        endfor;
        return response::json($datas);
    }
    public function getTotalStudentsMaleByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(start_at) as start_at_year'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $students = Student::join('formations', 'formations.id', 'students.formation_id')
                ->join('users', 'users.id', 'students.user_id')
                ->where('users.gender', 'LIKE', 'Homme')
                ->whereRaw('YEAR(start_at) <= '. $i)
                ->whereRaw('YEAR(end_at) >= '. $i)
                ->count('students.id');
            $datas[] = ['year'=>$i, 'total'=>$students];
        endfor;
        return response::json($datas);
    }

    public function getTotalStudentsFemaleByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(start_at) as start_at_year'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $students = Student::join('formations', 'formations.id', 'students.formation_id')
                ->join('users', 'users.id', 'students.user_id')
                ->where('users.gender', 'LIKE', 'Femme')
                ->whereRaw('YEAR(start_at) <= '. $i)
                ->whereRaw('YEAR(end_at) >= '. $i)
                ->count('students.id');
            $datas[] = ['year'=>$i, 'total'=>$students];
        endfor;
        return response::json($datas);
    }

    public function getTotalTeachersByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(start_at) as start_at_year'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $teachers = FormationDetail::select(DB::raw('COUNT(DISTINCT(formation_details.teacher_id)) as total_teacher'))->get()->first();
            $datas[] = ['year'=>$i, 'total'=>$teachers->total_teacher];
        endfor;
        return response::json($datas);
    }

    public function getTotalTeachersMaleByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(start_at) as start_at_year'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $teachers = FormationDetail::join('users', 'users.id', 'formation_details.teacher_id')
                ->select(DB::raw('COUNT(DISTINCT(formation_details.teacher_id)) as total_teacher'))
                ->where('users.gender', 'LIKE', 'Homme')
                ->get()->first();
            // dd($teachers);
            $datas[] = ['year'=>$i, 'total'=>$teachers->total_teacher];
        endfor;
        return response::json($datas);
        
    }

    public function getTotalTeachersFemaleByYear()
    {
        $firstYear = Formation::select(DB::raw('YEAR(start_at) as start_at_year'))->orderBy('start_at','asc')->get()->first();
        $firstYearInt = $firstYear->start_at_year;
        $now = Carbon::now()->year;
        $datas = [];
        for($i = $firstYearInt; $i <= $now; $i++):
            $teachers = FormationDetail::join('users', 'users.id', 'formation_details.teacher_id')
                ->select(DB::raw('COUNT(DISTINCT(formation_details.teacher_id)) as total_teacher'))
                ->where('users.gender', 'LIKE', 'Femme')
                ->get()->first();
            // dd($teachers);
            $datas[] = ['year'=>$i, 'total'=>$teachers->total_teacher];
        endfor;
        return response::json($datas);
    }

    public function getTotalSkillsValidatedByTeachersByMonthOfYear($year)
    {
        $datas = [];
        for($i = 1; $i <= 12; $i++):
            $skillsValidated = Progression::select('progressions.id')
                ->whereYear('progressions.teacher_validation_date', $year)
                ->where('progressions.teacher_validation', 1)
                ->whereRaw('MONTH(progressions.teacher_validation_date) = ' .$i)
                ->count();
            $datas[] = ['month'=>$i, 'total'=>$skillsValidated];
        endfor;
            
        return response::json($datas);
    }
    public function getTotalSkillsValidatedByStudentsByMonthOfYear($year)
    {
        $datas = [];
        for($i = 1; $i <= 12; $i++):
            $skillsValidated = Progression::select('progressions.id')
                ->whereYear('progressions.student_validation_date', $year)
                ->where('progressions.student_validation', 1)
                ->whereRaw('MONTH(progressions.student_validation_date) = ' .$i)
                ->count();
            $datas[] = ['month'=>$i, 'total'=>$skillsValidated];
        endfor;
            
        return response::json($datas);
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        if($user->delete()):
            return new UserR($user);
        endif;
    }

    public function teacherProfil($teacherId)
    {
        $users = User::select('users.lastname', 'users.firstname', 'users.avatar','users.email','user_types.name', 'users.birthday_date', 'users.gender', 'users.phone_number')
            ->join('user_types', 'user_types.id', 'users.user_type_id')
            // ->join('students', 'students.user_id', 'users.id')
            // ->join('formation_details', 'formation_details.teacher_id', 'users.id')
            // ->join('formations', 'formations.id', 'formation_details.formation_id')
            ->where('users.id', $teacherId)
            ->get();

            //On récupère les formations en cours que le formateur a
            foreach($users as $key=>$user):
                $formationIds = Formation::select(DB::raw('DISTINCT(formations.name) as formation_name, formations.logo, formations.start_at, formations.end_at, formations.id'))->join('formation_details', 'formations.id', 'formation_details.formation_id')->where('formation_details.teacher_id', $teacherId)->get();
                $users[$key]->formations = $formationIds;
            endforeach;

            return response::json($users);

            //fzfzzffz
    }

    public function adminProfil($adminId)
    {
        $users = User::select('users.lastname', 'users.firstname', 'users.avatar','users.email','user_types.name', 'users.birthday_date', 'users.gender', 'users.phone_number')
            ->join('user_types', 'user_types.id', 'users.user_type_id')
            ->where('users.id', $adminId)
            ->get();
            return response::json($users[0]);
    }

    public function studentProfil($studentId)
    {
        $users = User::select('users.lastname', 'users.firstname', 'users.avatar','users.email','user_types.name', 'users.birthday_date', 'users.gender', 'users.phone_number')
            ->join('user_types', 'user_types.id', 'users.user_type_id')
            ->where('users.id', $studentId)
            ->get();

            foreach($users as $key=>$user):
                $formations = Formation::select('formations.name', 'formations.id', 'formations.logo', 'formations.id', 'formations.start_at', 'formations.end_at')
                    ->join('students', 'students.formation_id', 'formations.id')
                    ->where('students.user_id', $studentId)
                    ->get();
                    //feagaeg
                $users[$key]->formations = $formations;
            endforeach;
            
            return response::json($users[0]);
    }
}
