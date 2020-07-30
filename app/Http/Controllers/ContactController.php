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


    public function storeFormContact(Request $request, $id = null)
    {
        $storeFormContact = $this->repo->storeFormContact($request,$id);
        if(!$storeFormContact['status']){
            return response()->json('Create or update error: ' . json_encode($storeFormContact['message']));
        }
        return response()->json('Create or update success: ' . json_encode($storeFormContact['message']));
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
