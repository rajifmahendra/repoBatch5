<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Repo\Repository;
use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    protected $repo;

    public function __construct(){
        $this->repo = new Repository();
    }
    
    public function indexFormContact($id = null)
    {
        return view('form-test');
    }

    // public function create()
    // {
    //     //
    // }


    public function storeFormContact(Request $request, $id = null){
        $storeFormContact = $this->repo->storeFormContact($request, $id);
        // dd($storeFormContact);
        if (!$storeFormContact['status']){
            return redirect('/contact')->with('pesan', "Pesan anda gagal terkirim");
        }
        return redirect('/contact')->with('pesan', "Succes mengirim pesan");
    }


    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        //
    }


    public function update(Request $request, Contact $contact)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        //
    }
}
