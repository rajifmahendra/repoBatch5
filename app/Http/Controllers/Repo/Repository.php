<?php

namespace App\Http\Controllers\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;




class Repository{
    public function __construct(){

    }

    public function standardPhone($phone, $countryID = 'ID'){
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $parsePhone = $phoneUtil->parse($phone, $countryID);
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }

        $isvalid = $phoneUtil->isValidNumber($parsePhone);

        if(!$isvalid){
            return false;
        }

        try {
            $correctPhone = $phoneUtil->format($parsePhone, \libphonenumber\PhoneNumberFormat::E164);
        } catch (\libphonenumber\NumberParseException $e) {
            $correctPhone = false;
        }

        return $correctPhone;
    }

    public function changeCountry($phone = '', $countryID = '', $mobileOnly = true){
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        try {
            $parsePhone = $phoneUtil->parse($phone, $countryID);
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }

        $isvalid = $phoneUtil->isValidNumber($parsePhone);

        if(!$isvalid){
            return false;
        }

        if($mobileOnly){
            $isMobile = $phoneUtil->getNumberType($parsePhone);
            if($isMobile !== 1){
                return false;
            }
        }

        try {
            $correctPhone = $phoneUtil->format($parsePhone, \libphonenumber\PhoneNumberFormat::E164);
        } catch (\libphonenumber\NumberParseException $e) {
            $correctPhone = false;
        }

        return $correctPhone;
    }

    public function findContactById($id){
        return Contact::where('id', $id)->firstOrFail();
    }

    public function storeFormContact($request, $id = null){
        $result     = ['status' => false, 'message' => ''];
        $validator  = Validator::make($request->all(),
            [
                'full_name'    => 'required|max:50',
                'phone'        => 'required|max:20',
                'email'        => 'required|email'
            ]
        );
        if ($validator->fails()) {
            $result['message'] = $validator->errors()->first();
            return $result;
        }
        $contact        = new Contact();
        if ($id){
            $contact    = $this->findContactById($id);
        }
        $phoneService   = $this->standardPhone($request->phone);
        if (!$phoneService){
            $result['message'] = 'phone number is not valid';
            return $result;
        }
        $contact->full_name = $request->full_name;
        $contact->email     = $request->email;
        $contact->phone     = $request->phone;
        $contact->save();
        $result['status']   = true;
        $result['message']  = $contact;
        return $result;
    }
    
}

?>