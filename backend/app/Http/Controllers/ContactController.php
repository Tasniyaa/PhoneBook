<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
  public function contacts(){
    $contacts = Contact::all();
    return response()->json(
      [
        'contacts' => $contacts,
        'message' => 'Contacts',
        'code' => 200
      ]
    );
  }
  public function getContact($id){
    $contact = Contact::find($id);
    return response()->json($contact);
  }
  public function saveContact(Request $resquest){
    $contacts = new Contact();
    $contacts->name = $resquest->name;
    $contacts->email = $resquest->email;
    $contacts->designation = $resquest->designation;
    $contacts->contact_no = $resquest->contact_no;
    $contacts->save();
    return response()->json([
      'message' => 'Contact Created Successfully',
      'code' => 200,
      'contact' => $contacts,
    ]);
  }
  public function deleteContact($id){
    $contact = Contact::find($id);
    if($contact){
      $contact->delete();
      return response()->json([
        'message' => 'Contact deleted succesfully',
        'code' => 200
      ]);
    }else{
      return response()->json([
        'message' => "Contact with id: $id does not exist",
      ]);
    }
  } 
  public function updateContact($id, Request $resquest){
    $contact = contact::where('id', $id)->first();
    $contact->name = $resquest->name;
    $contact->email = $resquest->email;
    $contact->designation = $resquest->designation;
    $contact->contact_no = $resquest->contact_no;
    $contact->save();
    return response()->json([
      'message' => 'Contact Created Successfully',
      'code' => 200,
      'contact' => $contact,
    ]);
  }
}
