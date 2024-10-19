<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Lead;
use App\Mail\NewContact;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $form_data = $request->all();

        $validator = Validator::make(
            $form_data,
            [
                'name' => ['required', 'max:50'],
                'surname' => ['required', 'max:100'],
                'email' => ['required', 'max:150'],
                'phone' => ['required', 'max:20'],
                'content' => ['required'],
            ],
            [
                'name.required' => 'Il nome è obbligatorio',
                'name.max'      => 'Il nome deve essere lungo al massimo :max caratteri',
                'surname.required' => 'Il cognome è obbligatorio',
                'surname.max'      => 'Il cognome deve essere lungo al massimo :max caratteri',
                'email.required' => 'L\'indirizzo email è obbligatorio',
                'email.max'      => 'L\'indirizzo email deve essere lungo al massimo :max caratteri',
                'phone.required' => 'Il numero di telefono è obbligatorio',
                'phone.max'      => 'Il numero di telefono deve essere lungo al massimo :max caratteri',
                'content.required' => 'Il contenuto della mail è obbligatorio',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();

        Mail::to('info@stitchpress.it')->send(new NewContact($new_lead));

        return response()->json([
            'success' => true,
            'message' => 'Lead creato con successo',
            'lead' => $new_lead
        ]);
    }
}
