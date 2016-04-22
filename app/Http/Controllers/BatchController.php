<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Contact;


class BatchController extends Controller
{
    //

    public function action(Request $request)
    {
        //dd($request);

        if ($request->input('action')== "delete") {
            foreach ($request->input('check') as $contact_id => $value)
            {
                   Contact::findOrFail($contact_id)->delete();
            }

            flash()->success('L\'organisme a bien été effacé');
        }


        return redirect()->route('admin.contact.index');

    }


}
