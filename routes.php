<?php
Route::group(array('module'=>'volunteer','namespace' => 'App\PiplModules\volunteer\Controllers','middleware'=>'web'), function() {
        //Your routes belong to this module.
	Route::get("/admin/volunteer/list","VolunteerController@listVolunteers")->middleware('permission:view.skills');
	Route::get("/admin/volunteer/list-data","VolunteerController@listVolunteersData")->middleware('permission:view.skills');
	Route::get("/admin/volunteer/create","VolunteerController@createVolunteer")->middleware('permission:create.skills');
	Route::post("/admin/volunteer/create","VolunteerController@createVolunteer")->middleware('permission:create.skills');
	Route::get("/admin/volunteer/update/{volunteer_id}","VolunteerController@updateVolunteer")->middleware('permission:update.skills');
	Route::post("/admin/volunteer/update/{volunteer_id}","VolunteerController@updateVolunteer")->middleware('permission:update.skills');
	Route::delete("/admin/volunteer/{volunteer_id}","VolunteerController@deleteVolunteer");
	Route::delete("/admin/volunteer-delete-selected/{volunteer_id}","VolunteerController@deleteSelectedVolunteer")->middleware('permission:delete.skills');
});