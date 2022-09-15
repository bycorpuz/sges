<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'LoginController@index')->name('login');
    Route::post('/', 'LoginController@login');
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/home', 'AdminController@index')->name('admin_home');
    Route::post('/admin/profile/update', 'AdminController@updateProfile')->name('update_profile');

    //User for Comelec
    Route::get('/admin/user', 'ComelecAccountController@comelectList')->name('user_comelec_list');
    Route::post('/admin/user', 'ComelecAccountController@comelectList');
    Route::post('/admin/user/update', 'ComelecAccountController@updateComelectAccount')->name('user_comelec_update');
    Route::get('/admin/user/add', 'ComelecAccountController@addComelecAccount')->name('user_comelec_add');
    Route::post('/admin/user/add', 'ComelecAccountController@createComelecAccount');
    Route::get('/admin/user/reset', 'ComelecAccountController@resetComelecAccount')->name('user_comelec_reset');
    Route::get('/admin/user/delete', 'ComelecAccountController@deleteComelectAccount')->name('user_comelec_delete');
    Route::get('/admin/user/info', 'ComelecAccountController@getComelectAccountInfo');
    
    //Schools
    Route::get('/admin/school', 'SchoolController@schoolList')->name('school_list');
    Route::post('/admin/school', 'SchoolController@updateSchool');
    Route::get('/admin/school/add', 'SchoolController@addSchool')->name('school_add');
    Route::post('/admin/school/add', 'SchoolController@createSchool');
    Route::get('/admin/school/delete', 'SchoolController@deleteSchool')->name('school_delete');
    
    //Main School
    Route::get('/admin/school/update', 'MainSchoolController@updateSchool')->name('update_school_info');
    Route::post('/admin/school/update', 'MainSchoolController@updateSchoolInfo');
    
    //System
    Route::get('/system/reset', 'SystemController@reset')->name('system_reset');
    Route::post('/system/reset', 'SystemController@resetSystem');
    
    //Ajax
    Route::get('/searchDivisionByRegion', 'AjaxController@searchDivisionByRegion')->name('search_division_by_region');

});

Route::group(['middleware' => ['comelec']], function () {
    Route::get('/comelec/home', 'ComelecController@index')->name('comelec_home');

    //Party List
    Route::get('/comelec/party', 'PartyListController@partyList')->name('party_list');
    Route::post('/comelec/party', 'PartyListController@partyList');
    Route::get('/comelec/party/add', 'PartyListController@addParty')->name('party_add');
    Route::post('/comelec/party/add', 'PartyListController@createParty');
    Route::get('/comelec/party/delete', 'PartyListController@deleteParty')->name('party_delete');
    Route::post('/comelec/party/update', 'PartyListController@updateParty')->name('party_update');
    Route::get('/comelec/party/info', 'PartyListController@getPartyListInfo');
    
    //Postition
    Route::get('/comelec/position', 'PositionController@positionList')->name('position_list');
    Route::post('/comelec/position', 'PositionController@positionList');
    Route::get('/comelec/position/add', 'PositionController@addPosition')->name('position_add');
    Route::post('/comelec/position/add', 'PositionController@createPosition');
    Route::get('/comelec/position/delete', 'PositionController@deletePosition')->name('position_delete');
    Route::post('/comelec/position/update', 'PositionController@updatePosition')->name('position_update');
    
    //Candidate
    Route::get('/comelec/candidate', 'CandidateController@candidateList')->name('candidate_list');
    Route::post('/comelec/candidate', 'CandidateController@candidateList');
    Route::get('/comelec/candidate/add', 'CandidateController@addCandidate')->name('candidate_add');
    Route::post('/comelec/candidate/add', 'CandidateController@createCandidate');
    Route::get('/comelec/candidate/delete', 'CandidateController@deleteCandidate')->name('candidate_delete');
    Route::post('/comelec/candidate/update', 'CandidateController@updateCandidate')->name('candidate_update');
    Route::get('/comelec/candidate/info', 'CandidateController@getCandidateInfo');
    
    //Voter
    Route::get('/comelec/voter', 'voterAccountController@voterList')->name('voter_list');
    Route::post('/comelec/voter', 'voterAccountController@voterList');
    Route::get('/comelec/voter/add', 'voterAccountController@addVoter')->name('voter_add');
    Route::post('/comelec/voter/add', 'voterAccountController@createVoter');
    Route::get('/comelec/voter/upload', 'voterAccountController@uploadVoter')->name('voter_upload');
    Route::post('/comelec/voter/upload', 'voterAccountController@uploadVoterList');
    Route::post('/comelec/voter/update', 'voterAccountController@updateVoter')->name('voter_update');
    Route::get('/comelec/voter/delete', 'voterAccountController@deleteVoter')->name('voter_delete');
    Route::get('/comelec/voter/info', 'voterAccountController@getVoterInfo');


    //Template
    Route::get('/comelec/voter/downloadTemplate', 'voterAccountController@asd')->name('voter_template');

    //Reports
    Route::get('/reports/voter_list','PdfController@printPDF')->name('pdf');
    Route::get('/reports/submitted','PdfController@votedPDF')->name('submitted');
    Route::get('/reports/not_submitted','PdfController@notvotedPDF')->name('not_submitted');
    Route::get('/reports/officers/elected','PdfController@electedofficers')->name('elected_officers');
    Route::get('/reports/counts','PdfController@officialresult')->name('counts');
    Route::get('/reports/winners','PdfController@winners')->name('winners');
});

Route::group(['middleware' => ['voter']], function () {
    Route::get('/voter/home', 'voterController@index')->name('voter_home');
    Route::post('/voter/vote/cast', 'voterController@castVote')->name('cast_vote');
    Route::get('/voter/vote/success', 'voterController@successVote')->name('success_vote');

});


Route::get('/logout', 'LoginController@logout')->name('logout');