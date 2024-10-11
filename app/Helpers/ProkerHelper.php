<?php

use Illuminate\Support\Facades\Auth;

function filterRole() {
    
    $user = Auth::user(); // Get the authenticated user
    $userRoleId= $user->role_id;
    $userDivisionId = $user->division_id;
    $userDepartmentId = $user->department_id;
    
    $where = array();

        
    if ($userRoleId == 2) {
        $where = [
            ['division_id', $userDivisionId],
            ['department_id', null]
        ];
    }
    
    if ($userRoleId == 3) {
        $where = [
            ['department_id', $userDepartmentId]
        ];
    }

    return $where;
}