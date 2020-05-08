<?php 

Route::group(function () {
    Route::get('/', 'GroupController@index');
    Route::post('/', 'GroupController@store');
    Route::get('/{id}', 'GroupController@show');
    Route::delete('/{id}', 'GroupController@destroy');
    Route::delete('/{id}/force', 'GroupController@forceDestroy');
    Route::get('/me/{group_id}', 'GroupController@me');
    Route::get('/init-group/{currency}', 'GroupController@beforeCreate');
    Route::get('/members/{group_id}', 'GroupController@members');
    Route::get('/admins/{group_id}', 'GroupController@admins');
    Route::get('/contriburions/{group_id}', 'GroupController@contriburions');
    Route::get('/wallet/{group_id}', 'GroupController@wallet');
    Route::get('/approvers/{group_id}/{approver_type}', 'GroupController@approvers');
    Route::post('/join', 'GroupController@join');
    Route::get('/validate/{member_id}', 'GroupController@validateMember');
    Route::get('/leave-request/{group_id}', 'GroupController@leaveRequest');
    Route::post('/leave', 'GroupController@leave');
    Route::post('/make-admin', 'GroupController@makeAdmin');
    Route::post('/revoke-admin', 'GroupController@revokeAdmin');
    Route::post('/make-approver', 'GroupController@makeApprover');
    Route::post('/revoke-approver', 'GroupController@revokeApprover');
    Route::get('/settings/{group_id}', 'GroupController@settings');
    Route::get('/projects/{group_id}', 'GroupController@projects');
    Route::get('/activities/{group_id}', 'GroupController@activities');
    Route::get('/loan-settings/{group_id}', 'GroupController@loanSettings');
    Route::get('/withdrawals/{group_id}', 'GroupController@withdrawals');
    Route::get('/withdrawal-settings/{group_id}', 'GroupController@withdrawalSettings');
    Route::get('/type/{type_id}', 'GroupController@byType');
    Route::get('/pending-payments/{group_id}', 'GroupController@pendingPayments');
    Route::get('/my-payments/{group_id}', 'GroupController@myPendingPayments');
    Route::post('/{id}', 'GroupController@update');
});