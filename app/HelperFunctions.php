<?php

namespace App;

trait HelperFunctions
{

    function getCompanyProjects()
    {

        $company = auth('company')->user();
        $projects = $company->projects()->pluck('title', 'id')->toArray();

        return $projects;


    }
        function getCompanyUsers()
    {

        $company = auth('company')->user();
        $employees = $company->employees()->pluck('first_name', 'id')->toArray();

        return $employees;


    }
}
