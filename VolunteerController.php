<?php

namespace App\PiplModules\volunteer\Controllers;

use Auth;
use Auth\User;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Storage;
use App\PiplModules\volunteer\Models\Volunteer;
use Datatables;

class VolunteerController extends Controller {

    public function listVolunteers() {

        $all_volunteers = Volunteer::all();
        return view('volunteer::list-volunteers', array('volunteers' => $all_volunteers));
    }

    public function listVolunteersData() {

        $all_volunteers = Volunteer::all();

        return Datatables::of($all_volunteers)
                        ->addColumn('Language', function($all_volunteers) {
                            $language = '<button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="langDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Another Language <span class="caret"></span> </button>
                         <ul class="dropdown-menu multilanguage" aria-labelledby="langDropDown">';
                            if (count(config("translatable.locales_to_display"))) {
                                foreach (config("translatable.locales_to_display") as $locale => $locale_full_name) {
                                    if ($locale != 'en') {
                                        $language.='<li class="dropdown-item"> <a href="' . url('admin/volunteer/update/' . $all_volunteers->id . '/' . $locale) . '">' . $locale_full_name . '</a></li>';
                                    }
                                }
                            }
                            return $language;
                        })
                        ->make(true);
    }

    public function createVolunteer(Request $request) {
        if ($request->method() == "GET") {
            return view("volunteer::create-volunteer");
        } else {
            $data = $request->all();
            $validate_response = Validator::make($data, array(
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email_id' => 'required',
                        'address' => 'required',
            ));

            if ($validate_response->fails()) {
                return redirect($request->url())->withErrors($validate_response)->withInput();
            } else {
                $created_volunteer = Volunteer::create(array('user_id' => Auth::user()->id));

                $created_volunteer->first_name = $request->first_name;
                $created_volunteer->last_name = $request->last_name;
                $created_volunteer->email_id = $request->email_id;
                $created_volunteer->address = $request->address;
                $created_volunteer->id = $created_volunteer->id;
                $created_volunteer->save();

                return redirect("admin/volunteer/list")->with('status', 'Volunteer created successfully!');
            }
        }
    }

    public function updateVolunteer(Request $request, $volunteer_id) {

        $volunteer_data = Volunteer::find($volunteer_id);

        if ($request->method() == "GET") {
            if ($volunteer_data) {
                return view("volunteer::update-volunteer", array("volunteer" => $volunteer_data));
            } else {
                return redirect('admin/volunteer/list');
            }
        } else{
            if ($volunteer_data) {
                $validation = Validator::make($request->all(), array(
                            'first_name' => 'required',
                            'last_name' => 'required',
                            'email_id' => 'required',
                            'address' => 'required',
                ));
            }if ($validation->fails()) {
                return redirect($request->url())->withErrors($validation)->withInput();
            }
 
            $volunteer_data->first_name=$request->first_name;
            $volunteer_data->last_name=$request->last_name;
            $volunteer_data->email_id=$request->email_id;
            $volunteer_data->address=$request->address;
            $volunteer_data->save();
           
            return redirect(url('admin/volunteer/list'))->with("status","Volunteer Updated successfully");
							
        }
    }

    public function deleteVolunteer($volunteer_id) {
        $volunteer = Volunteer::find($volunteer_id);
        
        if ($volunteer) {
            $volunteer->delete();
            return redirect("admin/volunteer/list")->with('status', 'Volunteer deleted successfully!');
        } else {
            return redirect('admin/volunteer/list');
        }
    }

    public function deleteSelectedVolunteer($volunteer_id) {
            
        $volunteer = Volunteer::find($volunteer_id);

        if ($volunteer) {
            $volunteer->delete();
            echo json_encode(array("success" => '1', 'msg' => 'Selected records has been deleted successfully.'));
        } else {
            echo json_encode(array("success" => '0', 'msg' => 'There is an issue in deleting records.'));
        }
    }

}
