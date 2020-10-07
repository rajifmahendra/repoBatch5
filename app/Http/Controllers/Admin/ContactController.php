<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\Http\Controllers\Repo\Repository;

class ContactController extends Controller
{

    protected $repo;
    
    public function __construct(){
        $this->repo = new Repository();
    }

    public function index(){
        $contact = Contact::all();
        return view('pages.admin.contact.index', compact('contact'));
    }

    public function show($id){
        $contact = Contact::findOrFail($id);
        return view('pages.admin.contact.detail', compact('contact'));
    }

    function update(Request $request, $id){
        $this->repo->storeFormContact($request, $id);
        return redirect('/admin/contact/'.$id);
    }

    
}