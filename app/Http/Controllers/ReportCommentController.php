<?php

namespace App\Http\Controllers;

use App\ReportComment;
use App\Http\Resources\ReportComment as ReportCommentR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ReportCommentController extends Controller
{
  public function all() 
  {
    $reportComments = ReportComment::select('report_comments.id as reportCommentId', 'text', 'user_id as userId', 'users.firstname as firstname', 'users.lastname as lastname', 'report_id')
    ->leftjoin('users', 'users.id', '=', 'report_comments.user_id')
    ->paginate(25);

    return Response::json($reportComments);
  }

  public function show($reportCommentId) 
  {
    $reportComments = ReportComment::select('report_comments.id as reportCommentId', 'text', 'user_id as userId', 'users.firstname as firstname', 'users.lastname as lastname', 'report_id')
    ->leftjoin('users', 'users.id', '=', 'report_comments.user_id')
    ->where('report_comments.user_id', '=', $reportCommentId)
    ->get()->first();

    return Response::json($reportComments);
  }

  public function commentByReport($reportId) 
  {
    $reportComments = ReportComment::select('report_comments.id as reportCommentId', 'text', 'user_id as userId', 'users.firstname as firstname', 'users.lastname as lastname', 'report_id')
    ->leftjoin('users', 'users.id', '=', 'report_comments.user_id')
    ->where('report_comments.report_id', '=', $reportId)
    ->paginate(25);

    return Response::json($reportComments);
  }

  public function store(Request $request)

  //========Méthode de création d'un nouveau commentaire==========================//
  //========Pour créer un novueau commentaire, il faut que le 'report_id' soit spécifié, seul un utilisateur connecté peut créer un commentaire==================//
  {
    //Récupération de l'id de l'utilisateur connecté
    $authUserId = Auth::user()->id;

    //si la méthode est un put, on effectue la modification
    if($request->isMethod('put')):
      $reportComment = 
        ReportComment::where([
          [ 'id', '=', $request->report_comment_id],
          [ 'user_id', '=', $authUserId]
        ])->get()->first();

      if(!empty($reportComment)):
        $reportComment->id = $request->input('report_comment_id');
        $reportComment->user_id = $authUserId;
        $reportComment->report_id = $request->input('report_id');
        $reportComment->text = $request->input('text');

        // dd($reportComment);

        if($reportComment->save()):
          return new ReportCommentR($reportComment);
        endif;

      else:
        return Response::json(['error'=>'Vous ne pouvez pas modifier de menu']);
      endif;
    
    //fin de la modification, ici on crée un nouveau commentaire
    else:
      $input = $request->all();
      $input['user_id'] = $authUserId;
      $reportComment = ReportComment::create($input);
      return new ReportCommentR($reportComment);
    endif;
  }

  public function destroy($reportCommentId)
  {
    //Récupération de l'id de l'utilisateur connecté
    $authUserId = Auth::user()->id;

    $reportComment = ReportComment::findOrFail($reportCommentId);
    //si le commentaire appartient a la personne connecté, la suppression peut se faire
    if(($reportComment->user_id) == ($authUserId)): 
      if($reportComment->delete()):
        return new ReportCommentR($reportComment);
      endif;
    else:
      //sinon on retourne une erreur
      return Response::json(['error'=>'ce commentaire ne vous appartient pas']);
    endif;
  }
}
