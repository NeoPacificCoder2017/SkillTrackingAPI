<?php

namespace App;
use App\Progression;

use Illuminate\Database\Eloquent\Model;

class Progression extends Model
{
    protected $fillable = [
        'student_id', 'skill_id', 'student_validation', 'teacher_validation'
    ];

    public static function getStudentProgressionByModuleId($moduleId) {
        
    }

    public static function getProgressionsByStudentIdAndByFormationId($formationId, $userId) {
        $progressions = Progression::
            select('progressions.*')
            ->where([
                ['progressions.student_id',$userId],
            ])->get();

        $studentValitations = $teacherValidations = 0;

        foreach($progressions as $progression):
            if($progression->student_validation) $studentValitations++;
            if($progression->teacher_validation) $teacherValidations++;
        endforeach;

        $newProgressions = [
            'totalSkills' => $progressions->count(),
            'studentValidations' => $studentValitations,
            'teacherValidations' => $teacherValidations,
        ];

        return $newProgressions;
    }

    public static function createProgressionForStudentOfFormation($studentId, $formationId) {
        $skills = Skill::select('skills.id')
        ->join('modules', 'modules.id', 'skills.module_id')
        ->join('formation_details', 'formation_details.module_id', 'modules.id')
        ->join('formations','formations.id', 'formation_details.formation_id')
        ->join('students', 'students.formation_id', 'formations.id')
        ->groupBy('skills.id')
        ->where('students.formation_id', $formationId)
        ->get();

        foreach($skills as $skill):
            $progressionData = [
                'student_id' => $studentId,
                'formation_id' => $formationId,
                'skill_id' => $skill->id
            ];
            $progression = Progression::create($progressionData);
        endforeach;
    }
}
