<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('password/find/{token}', 'PasswordResetController@find');
Route::post('password/forgot', 'PasswordResetController@create');
Route::post('password/reset', 'PasswordResetController@reset');

/**
 * Connexion d'un utilisateur
 * Enregistrement d'un nouvel utilisateur
 */
  Route::post('login', 'UserController@login');

  /**
   * Liste de tout les utilisateurs présent dans l'api
   */
  Route::get('users', 'UserController@all');
  /*
   * Toutes les routes présentes dans le middleware requiert une authentification-+
   */
  Route::group(['middleware' => 'auth:api'], function(){
    Route::delete('user/{userId}', 'UserController@destroy');

    /**
     * page profil
     */
    Route::get('profil', 'StudentController@getStudentProfil');
    Route::get('profilOf/{userId}', 'StudentController@getStudentProfilByUserId');
    Route::get('profilsForAdmin', 'StudentController@getStudentProfilForAdmin');

    Route::get('fillBusinesses', 'BusinessController@fillBusinesses');
    Route::post('register', 'UserController@register');

    Route::post('user/update/{userId}', 'UserController@update');
    /**
     * Créer un nouveau étudiant
     */
    Route::post('createStudent', 'StudentController@createStudent');

    /**
     * Déconnexion d'un utilisateur
     */
    Route::get('logout','UserController@logout');

    /**
     *  Get students non active
     */
    Route::get('getFreeStudents', 'UserController@getFreeStudents');

    /*
     * Les trois routes qui suivents permettent de récupérer les différents type d'utilisateur présent dans l'api
     */
    Route::get('users/admin','UserController@listUsersAdmin');
    Route::get('users/student','UserController@listUsersStudent');
    Route::get('users/teacher','UserController@listUsersTeacher');

    /*
     * Affiliation d'un student à une formation
     */
    Route::post('fillstudent', 'UserController@fillStudent');

    /*
     * Routes pour les utilisateurs connecté en tant que student
     */

    Route::get('getPlanningForAdmin' , 'CalendarController@getPlanningForAdmin');
    Route::get('getAllFormations', 'StudentController@getAllFormations');

    Route::get('getReportsCreator', 'ReportController@getReportsCreator');

    Route::get('ReportComments', 'ReportCommentController@all');
    Route::get('ReportComment/{reportCommentId}', 'ReportCommentController@show');
    Route::get('commentsByReport/{reportId}', 'ReportCommentController@commentByReport');
    Route::post('reportComment/create', 'ReportCommentController@store');
    Route::delete('ReportComment/{reportCommentId}', 'ReportCommentController@destroy');
    Route::put('ReportComment/', 'ReportCommentController@store');

    //***************Routes concernant le controlleur FormationController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de toutes les Formation
    Route::get('formations', 'FormationController@all');
    //=======================Récupération d'une formation par son id
    Route::get('formation/{formationId}', 'FormationController@show');
    //=======================Création d'une formation
    Route::post('formation/create', 'FormationController@store');
    //=======================Assignement d'un
    Route::post('formation/create', 'FormationController@store');
    //=======================Supression d'une formation
    Route::delete('formation/{formationId}', 'FormationController@destroy');
    //=======================Modification d'une formation
    Route::post('editFormation/{formationId}', 'FormationController@editFormation');

    Route::get('studentsFormation', 'FormationController@getStudentsFormation');

    //======================= Récupération des informations du student connecté => formation + modules + skills + progression
    Route::get('getFormations', 'StudentController@getSkillsAuthUser');
    Route::get('getFormationForAdmin/{formationId}', 'StudentController@getSkillsByFormation');

    Route::get('getStudentsOfFormation/{formationId}', 'StudentController@getStudentsByFormationId');

    Route::get('getStudentDatas/{userId}/ofFormation/{formationId}', 'StudentController@getStudentSkillsByModule');

    Route::get('progressionsBySkillsOfModule/{moduleId}', 'ProgressionController@progressionsBySkills');
    Route::get('skillsByModule/{moduleId}', 'ProgressionController@skillsByModule');

    Route::get('getAllStudentsNotInFormation/{formationId}', 'StudentController@getAllStudentsNotInFormation');
    //***************Routes concernant le controlleur ModuleController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de toutes les Formation
    Route::get('modules', 'ModuleController@all');
    //=======================Récupération d'une formation par son id
    Route::get('module/{modulesId}', 'ModuleController@show');
    //=======================Création d'une formation
    Route::post('module/create', 'ModuleController@store');
    //=======================Supression d'une formation
    Route::delete('module/{modulesId}', 'ModuleController@destroy');
    //=======================Modification d'une formation
    Route::put('module', 'ModuleController@store');

    //***************Routes concernant le controlleur FormationController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de tous les reports
    Route::get('report/reportsAvailableForTeacher', 'ReportController@getReportsForTeacher');
    Route::get('reportsForAdmin', 'ReportController@reportsForAdmin');
    Route::get('reports/{dateFilter}/{userFilter}', 'ReportController@getReports');
    Route::get('report/getStudentsReport', 'ReportController@getStudentsReport');
    Route::get('report/getStudentsReportByFormation', 'ReportController@getStudentsReportByFormationId');
    //=======================Récupération d'un reports par son id
    Route::get('report/{reportId}', 'ReportController@show');
    Route::get('reportsByFormation/{formationId}', 'ReportController@getReportsByFormationId');
    Route::get('reportofStudent/{reportId}', 'ReportController@getReportsByFormationIdAndStudentId');
    //=======================Création d'une report
    Route::post('report/create', 'ReportController@store');
    //=======================Supression d'une report
    Route::delete('report/{reportId}', 'ReportController@destroy');
    //=======================Modification d'une report
    Route::put('report', 'ReportController@store');
    Route::get('reportForAdminByStudentId/{studentId}', 'ReportController@reportForAdminByStudentId');
    /**
     * Get one report for teacher
     */
    Route::get('getReport/{reportId}/ofFormation/{formationId}', 'ReportController@getOneReport');
    Route::get('getAllFormationsForAdmin', 'FormationController@getAllFormationsForAdmin');


    //***************Routes concernant le controlleur SkillController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de toutes les skills
    Route::get('skills', 'SkillController@all');
    //=======================Récupération d'un skill par son id
    Route::get('skill/{skillId}', 'SkillController@show');
    //=======================Création d'un skill
    Route::post('skill/create', 'SkillController@store');
    //=======================Supression d'un skill
    Route::delete('skill/{skillId}', 'SkillController@destroy');
    //=======================Modification d'un skill
    Route::put('skill', 'SkillController@store');


    //***************Routes concernant le controlleur Student****************************//
    //************************************************************************************//

    //=======================Récupération de tous les étudiants
    Route::get('students','StudentController@all');
    //=======================Récupération d'un étudiant par sont ID
    Route::get('student/{studentID}','StudentController@show');
    //=======================Modification d'un étudiant
    Route::post('student/create','StudentController@store');
    //=======================Suppréssion d'un étudiant
    Route::delete('student/{studentID}','StudentController@destroy');
    //=======================Modification d'un étudiant
    Route::put('student','StudentController@store');


    //***************Routes concernant le controlleur Calendar****************************//
    //***********************************************************************************//

    Route::get('calendars', 'CalendarController@getCalendarsForAdmin');
    Route::get('calendar/{calendarId}', 'CalendarController@show');
    Route::post('calendar/create', 'CalendarController@store');
    Route::delete('calendar/{calendarId}', 'CalendarController@destroy');
    Route::put('calendar', 'CalendarController@store');
    Route::post('editCalendar/{calendarId}', 'CalendarController@editCalendar');
    Route::get('teachers/calendar', 'CalendarController@getCalendarForTeachers');
    Route::get('students/calendar', 'CalendarController@getStudentsCalendar');
    Route::get('getCalendarOfFormation/{formationId}', 'CalendarController@getCalendarForFormation');

    //***************Routes concernant le controlleur ProgressionController****************************//
    //*************************************************************************************************//

    //=======================Récupération de toutes les Progressions
    Route::get('progressions', 'ProgressionController@all');
    //=======================Récupération d'une Progressions par son id
    Route::get('progression/{progressionsId}', 'ProgressionController@show');
    //=======================Création d'une Progressions
    Route::post('progression/create', 'ProgressionController@store');
    //=======================Supression d'une Progressions
    Route::delete('progression/{ProgressionsId}', 'ProgressionController@destroy');
    //=======================Modification d'une Progressions
    Route::put('progression', 'ProgressionController@store');
    Route::put('progression/updateStudentValidation', 'ProgressionController@updateStudentValidation');
    Route::put('progression/updateTeacherValidation', 'ProgressionController@updateTeacherValidation');
    Route::put('progression/updateAllTeacherValidation', 'ProgressionController@updateAllTeacherValidation');
    Route::put('progression/updateAllStudentValidation', 'ProgressionController@updateAllStudentValidation');
    Route::get('getProgressionForAdminByStudentId/{studentId}', 'ProgressionController@getProgressionForAdminByStudentId');

    //***************Routes concernant le controlleur FormationDetailController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de toutes les FormationDetail
    Route::get('formationdetails', 'FormationDetailController@all');
    //=======================Récupération d'une formationdetail par son id
    Route::get('formationdetail/{formationdetailsId}', 'FormationDetailController@show');
    //=======================Création d'une formationdetail
    Route::post('formationdetail/create', 'FormationDetailController@store');
    //=======================Supression d'une formationdetail
    Route::delete('formationdetail/{fformationdetailsId}', 'FormationDetailController@destroy');
    //=======================Modification d'une formationdetail
    Route::put('formationdetail', 'FormationDetailController@store');
    //============Récupérer les modules de l'utilisateur connecte==============================
    Route::get('modulesByStudent', 'FormationDetailController@getModulesByAuthUser');
    //============Récupérer les skills de l'utilisateur connecté===============================
    Route::get('skillsByStudent', 'FormationDetailController@getSkillsByAuthUser');
    //============Récupérer les formations d'un formateur ======================================
    Route::get('teacher/myFormations', 'FormationController@getFormationsOfTeacher');

    //***************Routes concernant le controlleur UserTypeController****************************//
    //*******************************************************************************************************//

    //=======================Récupération de toutes les usertypes
    Route::get('usertypes', 'UserTypeController@all');
    //=======================Récupération d'une usertypes par son id
    Route::get('usertype/{usertypesId}', 'UserTypeController@show');
    //=======================Création du usertypes
    Route::post('usertype/create', 'UserTypeController@store');
    //=======================Supression du usertypes
    Route::delete('usertype/{usertypesId}', 'UserTypeController@destroy');
    //=======================Modification du usertypes
    Route::put('usertype', 'UserTypeController@store');

    Route::put('isMandatoryUpdate', 'ProgressionController@isMandatoryUpdate');

    //***************Routes concernant le controlleur Parameters****************************//
    //*******************************************************************************************************//
    //=======================Récupération de toutes les usertypes
    Route::get('parameters', 'ParameterController@all');
    //=======================Récupération d'un parametre par son id
    Route::get('parameter/{parameterId}','ParameterController@show');
    //=======================Création du parameter
    Route::post('parameter/create', 'ParameterController@store');
    //=======================Supression du parameter
    Route::delete('parameter/{parameterId}', 'ParameterController@destroy');
    //=======================Modification du usertypes
    Route::put('parameter', 'ParameterController@store');

    /**
     * Route récupération des teachers d'une formation
     */
    Route::get('getTeachersOfFormation/{formationId}', 'FormationController@getTeachersByFormationId');

    /**
     * Route récupération des students d'une formation par l'id de la formation
     */
    Route::get('getStudentsOfAFormation/{formationId}','FormationController@getStudentsByFormationId');

    /**
     * Route de récupération des modules + progression du module
     */
    Route::get('getModulesOfFormation/{formationId}','FormationController@getModulesByFormationId');

    /**
     * Route d'ajout des progressions
     */

     Route::post('addProgressionsFor/{studentId}/ofFormation/{formationId} ', 'ProgressionController@addProgression');

    /**
    * Get total formations
    */
    Route::get('getTotalFormations', 'FormationController@getTotalFormations');

    /**
     * Get total students
     */
    Route::get('getTotalStudents', 'FormationController@getTotalStudents');

    /**
    * Get total teachers
    */
    Route::get('getTotalTeachers', 'FormationController@getTotalTeacher');

    /**
     * Get total modules
     */
    Route::get('getTotalModules', 'FormationController@getTotalModules');


    /**
    * Get total skills,
    */
    Route::get('getTotalSkills', 'FormationController@getTotalSkills');


    /**
     * Get total skills validated by students
     */
    Route::get('getTotalSkillsValidatedByStudents', 'FormationController@getTotalSkillsValidatedByStudents');


    /**
    * Get total skills validated by teachers
    */
    Route::get('getTotalSkillsValidatedByTeachers', 'FormationController@getTotalSkillsValidatedByTeachers');

    /**
     * Get active formation
     * @param nom de la formation, id de la formation, la progressions de skills validé (students et teachers), date début, date fin
     */
    Route::get('getActiveFormation', 'FormationController@getActiveFormation');

    Route::get('teacherProfil/{teacherId}', 'UserController@teacherProfil');
    Route::get('adminProfil/{adminId}', 'UserController@adminProfil');
    Route::get('studentProfil/{studentId}', 'UserController@studentProfil');
    /**
     * Dashboard ADMIN
     */
    Route::get('getTotalMales', 'UserController@getTotalMales');
    Route::get('getTotalFemales', 'UserController@getTotalFemales');
    Route::get('getTotalFormationsHours', 'UserController@getTotalFormationsHours');
    Route::get('getTotalBusinesses', 'UserController@getTotalBusinesses');
    Route::get('getTotalStudentsByYear', 'UserController@getTotalStudentsByYear');
    Route::get('getTotalStudentsMaleByYear', 'UserController@getTotalStudentsMaleByYear');
    Route::get('getTotalStudentsFemaleByYear', 'UserController@getTotalStudentsFemaleByYear');
    Route::get('getTotalTeachersByYear', 'UserController@getTotalTeachersByYear');
    Route::get('getTotalTeachersMaleByYear', 'UserController@getTotalTeachersMaleByYear');
    Route::get('getTotalTeachersFemaleByYear', 'UserController@getTotalTeachersFemaleByYear');
    Route::get('getTotalSkillsValidatedByTeachersByMonthOfYear/{year}', 'UserController@getTotalSkillsValidatedByTeachersByMonthOfYear');
    Route::get('getTotalSkillsValidatedByStudentsByMonthOfYear/{year}', 'UserController@getTotalSkillsValidatedByStudentsByMonthOfYear');
    Route::get('getTotalProgressions', 'ProgressionController@getTotalProgressions');

    /**
     * Organizations
     */
    Route::get('getFormationsDataForOrganizations', 'OrganizationFormationAcessController@getFormationForOrganization');

  });



