<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = Contact::query();

        if ($request->ajax()) {
            if($search = request('s')) {
                $contact->whereLike(['email', 'first_name', 'last_name'], $search);
            }

            $contacts = $contact->latest()->paginate(10);

            return view('contacts._partial', compact('contacts'))->render();
    	}

        $contacts = $contact->latest()->paginate(10);

        return view('contacts.index', [
            'contacts' => $contacts
        ]);   
    }









    public function create()
    {
        $contacts = Contact::latest()->paginate(10);
        
        return view('contacts.create', [
            'contacts' => $contacts
        ]);    
    }

    public function edit(Contact $contact)
    {
        
    }

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'zip' => ['required'],
            'type' => ['required'],
        ]);

        Contact::create($validated);

        session()->flash('success', 'Contacts created');

        if ($request->ajax()) {
            ////
        }

        return redirect()->back();
    }
}
