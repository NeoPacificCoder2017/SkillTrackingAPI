<?php

namespace App\Http\Controllers;

use App\Business;
use App\StudentBusiness;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class BusinessController extends Controller
{
    /**
     * Assignement d'un étudiant a son entreprise respective
     * 
     */
    public function fillBusinesses(Request $request)
    {
        if(Auth::user()->user_type_id == 1):
            $input = $request->all();   
            $studentBusiness = StudentBusiness::find($input['student_id']);
            $studentBusiness->business_id = $input['business_id'];
            $studentBusiness->save();
        else:
            return Response::json(["Erreur : "=>"Vous n'avez pas les droits"]);
        endif;
    }

    /**
     * Liste des entreprises présentes dans la base de données
     * @return response
     */
    public function listBusinesses()
    {
        $businesses = Business::select('*')->get();
        return response::json($businesses);
    }
}
