<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
        ]);
        $data['email'] = $request->email;
        $data['message'] = $request->message;
        $contact = Contact::create($data);
        if (!$contact) {
            toast('have error !!!', 'error');
            return redirect()->back();
        } else {
            toast('sant !!!', 'success');
            return redirect()->back();
        }
    }

    public function index()
    {
        $contacts = Contact::orderByDesc('id')->paginate(20);
        return view('admin.contact.index', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $proc = $contact->delete();
        if ($proc) {
            toast('deleted !!!', 'error');
            return redirect()->back();
        } else {
            toast('cant delete contact !!!', 'error');
            return redirect()->back();
        }
    }
}
