<?php

namespace App\Http\Controllers;

use App\RequestDoc;
use App\Parameter;
use App\UserType;

use App\Http\Resources\RequestDoc as RequestDocR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RequestDocController extends Controller
{
    public function all()
    {
      $request_docs = DB::table('request_docs')->orderBy('user_type_id', 'asc')->get()->toArray();
      $parameters = DB::table('parameters')->orderBy('request_doc_id')->get()->toArray();
      $user_types = DB::table('user_types')->get();

      $userTypes = [];
      $userTypeId = 0;

      $parameterRequestId = 0;
      $parameterRequests = [];
      $i = 0;

        foreach($request_docs as $request):
          if($userTypeId != $request->user_type_id):
            $i++;
            $userTypeId = $request->user_type_id;
            $userType = UserType::find($userTypeId);
            $userTypes[$i]['user_type'] = $userType->name;
          endif;
          $userTypes[$i]['requests'][] = $request;
        endforeach;

        foreach($parameters as $parameter):
          $i++;
          $parameterRequestId = $parameter->request_doc_id;
          $parameterRequest = RequestDoc::find($parameterRequestId);
          $parameterRequests[$i]['request'] = $parameterRequest->method;
          $parameterRequests[$i]['parameterR'][] = $parameter;
        endforeach;

      // dd($userTypes);
      // dd($parameterRequests);

      return view('apidocs.apidocAll', ['userTypes' => $userTypes, 'parameterRequests' => $parameterRequests, 'user_types' => $user_types]);
    }

    public function destroy($requestdocId)
    {
        $request_docs = RequestDoc::findOrFail($requestdocId);

        if($request_docs->delete()):
            return new RequestDocR($request_docs);
        endif;
    }

    public function storeRequest(Request $request)
    {

      
        $validator = Validator::make($request->all(), [ 
          'title' => 'required', 
          'url' => 'required', 
          'method' => 'required', 
          'response' => 'required', 
          'description' => 'required', 
          'user_type_id' => 'required', 
          'color' => 'required'
      ]);

      if ($validator->fails()) {
        return redirect('apidoc/create')
                    ->withErrors($validator)
                    ->withInput();
    }


      $requests = new RequestDoc();
      $requests->title = $request->input('title');
      $requests->url = $request->input('url');
      $requests->method = $request->input('method');
      $requests->response = $request->input('response');
      $requests->description = $request->input('description');
      $requests->user_type_id = $request->input('user_type_id');
      $requests->color = $request->input('color');
      $requests->save();

      return view('apidocs.apidoc-create-confirmation');
    }

    public function addParams(Request $request)
    {
      $params = new Parameter();
      $params->request_doc_id = $request->input('requestdocId');
      $params->name = $request->input('name');
      $params->type = $request->input('type');
      $params->position = $request->input('position');
      $params->required = $request->input('required');
      $params->description = $request->input('description');
      $params->save();

      return view('apidocs.apidoc-form-params',['requestdocId'=>$request->input('requestdocId')]);
    }

    public function formRequest()
    {
      return view('apidocs.apidoc-form-request');
    }

    public function formParams($requestdocId) {
      return view('apidocs.apidoc-form-params',['requestdocId'=>$requestdocId]);
    }
}
