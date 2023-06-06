<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class LeadController extends Controller
{
   public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]
        );

        if($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'erros' => $validator->erros()
                ]
            );
        }

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('info@irenebri.it')->send(new NewContact($newLead));

        return response()->json(
            [
                'success' => true
            ]
        );
   }
}
