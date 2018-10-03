<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Contracts\Auth\CanResetPassword;

use App\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','lastname', 'firstname', 'email', 'password', 'user_type_id','avatar', 'gender','phone_number', 'birthday_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function AauthAcessToken(){
        return $this->hasMany('\App\OauthAccessToken');
    }

    public static function getMyCurrentFormation()
    {
        return Student::select('students.id as student_id', 'formations.name as formation_name', 'formations.id as formation_id','formations.start_at as formation_start_at', 'formations.end_at as formation_end_at' )
        ->join('formations', 'formations.id', 'students.formation_id')
        ->where('students.user_id', Auth::user()->id)
        ->where('students.active', 1)
        ->orderBy('students.id', 'desc')
        ->get()->first();
    } 

    public static function getCurrentFormationForTeacher()
    {
        return FormationDetail::select(DB::raw('DISTINCT(formation_details.formation_id) as formation_id, 
                formations.name, 
                formations.logo, 
                formations.start_at, 
                formations.end_at'))
        ->join('formations', 'formations.id', 'formation_details.formation_id')
        ->where('formation_details.teacher_id', Auth::user()->id)
        ->groupBy('formation_details.formation_id')
        ->pluck('formation_details.formation_id')->toArray();
    }

    public static function getCurrentFormationOfAStudent($formationId)
    {
        return Student::select('students.user_id as user_id', 'students.id as student_id', 'formations.name as formation_name', 'formations.id as formation_id','formations.start_at as formation_start_at', 'formations.end_at as formation_end_at' )
        ->join('formations', 'formations.id', 'students.formation_id')
        ->join('users', 'users.id', 'students.user_id')
        ->where('students.formation_id', $formationId)
        ->orderBy('students.id', 'desc')
        ->get()->first();
    } 

    public static function getAllFormationsActive() 
    {
        return Student::select('students.id as student_id', 'formations.name as formation_name', 'formations.id as formation_id','formations.start_at as formation_start_at', 'formations.end_at as formation_end_at' )
        ->join('formations', 'formations.id', 'students.formation_id')
        ->where('students.active', 1)
        ->orderBy('students.id', 'desc')
        ->get();
    }

    
}
