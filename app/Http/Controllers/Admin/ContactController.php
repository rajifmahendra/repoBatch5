<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = Contact::all();
        return view('pages.admin.contact.index', compact('contact'));
    }

    public function show($id){
        $contact = Contact::findOrFail($id);
        return view('pages.admin.contact.detail', compact('contact'));
    }
}
