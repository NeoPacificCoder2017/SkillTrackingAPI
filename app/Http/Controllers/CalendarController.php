<?php

namespace App\Http\Controllers;

use App\User;
use App\Calendar;
use App\Http\Controllers\Controller;
use App\Http\Resources\Calendar as CalendarR;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class CalendarController extends Controller
{
    /**
     * Récupère tous les planninge, toutes formation confondus (en pdf)
     * @return response JSON
     */
    public function getCalendarsForAdmin()
    {
        if(Auth::user()->user_type_id == 1):
            $calendars = Calendar::select('calendars.id','calendars.file_name', 'calendars.file_url','formation_id', 'formations.name')
            ->leftjoin('formations', 'formations.id', 'calendars.formation_id')
            ->paginate(25);

            return Response::json($calendars);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    public function getCalendarForFormation($formationId)
    {
        $calendars = Calendar::select('calendars.id as calendar_id', 'calendars.file_name', 'calendars.file_url', 'calendars.formation_id', 'formations.name')
            ->where('formation_id', $formationId)
            ->join('formations', 'formations.id', 'calendars.formation_id')
            ->get()->first();
        return response::json($calendars);
    }

    public function editCalendar($calendarId, Request $request)
    {
        $calendar = Calendar::where('id', '=', $calendarId)->get()->first();
        //on traite le fichier PDF
        if($request->hasfile('file_url')):
            $file = $request->file('file_url');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
            $file->move('uploads/calendars/', $filename);
        endif;

        if(!empty($calendar)):
            $calendar->formation_id = $request->input('formation_id');
            $calendar->file_url = $filename;
            $calendar->file_name = $request->input('file_name');

            if($calendar->save()):
                return new CalendarR($calendar);
            endif;
        endif;
    }

    /**
     * Récupère un planning par son id
     * @param calendarId
     * @return response JSON
     */
    public function show($calendarId)
    {
        if(Auth::user()->user_type_id == 1):
            $calendar = Calendar::select('calendars.id','file_name','formation_id', 'formations.name')
            ->leftjoin('formations', 'formations.id', 'calendars.formation_id')
            ->where('calendars.id', $calendarId)
            ->get()->first();
            return Response::json($calendar);
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    /**
     * Création d'un nouveau planning
     * @param Request $request 
     */
    public function store(Request $request)
    {
      if(Auth::user()->user_type_id == 1):
          if($request->isMethod('put')):
              $calendar = Calendar::where('id', '=', $request->calendar_id)->get()->first();
              //on traite le fichier PDF
              if($request->hasfile('file_url')):
                  $file = $request->file('file_url');
                  $extension = $file->getClientOriginalExtension(); // getting image extension
                  $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
                  $file->move('uploads/calendars/', $filename);
              endif;

              if(!empty($calendar)):
                  $calendar->id = $request->input('calendar_id');
                  $calendar->formation_id = $request->input('formation_id');
                  $calendar->file_url = $filename;
                  $calendar->file_name = $request->input('file_name');

                  if($calendar->save()):
                      return new CalendarR($calendar);
                  endif;
              endif;

              //fin de la modification, ici on crée un nouveau commentaire
          else:
              $input = $request->all();
              if($request->hasfile('file_url')):
                  $file = $request->file('file_url');
                  $extension = $file->getClientOriginalExtension(); // getting image extension
                  $filename = substr( md5( 1 . '-' . time() ), 0, 15).'.'.$extension;
                  $file->move('uploads/calendars/', $filename);
              endif;
              $input['file_url'] = $filename;
              $calendar = Calendar::create($input);
              return new CalendarR($calendar);
          endif;
      else:
          return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
      endif;
    }

    /**
     * Suppression d'un planning par son id
     * @param int $calendarId
     */
    public function destroy($calendarId)
    {
        if(Auth::user()->user_type_id == 1):
            $calendar = Calendar::findOrFail($calendarId);
            if($calendar->delete()):
                return Response::json(["Success : "=>"Le calendrier '$calendar->file_name' a bien été supprimé"]);
            endif;
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;  
    }

    /**
     * Récupère les planning du formateur connecté, toutes formation confondues
     * @return response json
     */
    public function getCalendarForTeachers()
    {
      if(Auth::user()->user_type_id == 2):
        $formationIds = User::getCurrentFormationForTeacher();
        $calendars = Calendar::select('calendars.id as calendar_id','calendars.file_url as calendar_file_url','formations.id as formation_id','formations.name as formation_name','formations.logo as formation_logo')
        ->join('formations','formations.id','calendars.formation_id')
        ->whereIn('formation_id', $formationIds)->get();
        return Response::json($calendars);
      else:
        return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
      endif;
    }

    /**
     * Récupère les plannings de l'étudiant connecté, toutes formations confondues
     * @return response json
     */
    public function getStudentsCalendar()
    {
      $formationId = User::getMyCurrentFormation()->formation_id;
      $calendar = Calendar::select('calendars.*','formations.*')
        ->join('formations','formations.id','calendars.formation_id')
        ->where('calendars.formation_id', $formationId)
        ->get()->first();

        return response::json($calendar);
    }
}
