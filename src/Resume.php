<?php


namespace HhClient;


class Resume implements \JsonSerializable
{

    private $last_name;
    private $first_name;
    private $middle_name;
    private $birth_date;
    private $gender;
    private $photo;
    private $portfolio;
    private $area;
    private $metro;
    private $relocation;
    private $business_trip_readiness;
    private $contact = [];
    private $site;
    private $title;
    private $specialization = [];
    private $professional_roles = [];
    private $salary;
    private $employments;
    private $schedules = [];
    private $education;
    private $language = [];
    private $experience = [];
    private $skills;
    private $skill_set = [];
    private $citizenship = [];
    private $work_ticket;
    private $travel_time;
    private $recommendation = [];
    private $resume_locale;
    private $driver_license_types = [];
    private $has_vehicle;
    private $hidden_fields = [];
    private $access;

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }

}
