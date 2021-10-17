<?php


namespace HhClient;


use DateTime;
use JsonSerializable;
use UnexpectedValueException;

class Resume implements JsonSerializable
{
    /**
     * @var string|null
     */
    private $id;
    /**
     * @var string|null
     */
    private $last_name;
    /**
     * @var string|null
     */
    private $first_name;
    /**
     * @var string|null
     */
    private $middle_name;
    /**
     * String date in Y-m-d format
     * @var string|null
     */
    private $birth_date;
    /**
     * @var string|null
     */
    private $gender;
    /**
     * @var array|null
     */
    private $photo;
    /**
     * @var array|null
     */
    private $portfolio;
    /**
     * @var array|null
     */
    private $area;
    /**
     * @var array|null
     */
    private $metro;
    /**
     * @var array|null
     */
    private $relocation;
    /**
     * @var array|null
     */
    private $business_trip_readiness;
    /**
     * @var array|null
     */
    private $contact;
    /**
     * @var array|null
     */
    private $site;
    /**
     * @var string|null
     */
    private $title;
    /**
     * @var array|null
     */
    private $specialization;
    /**
     * @var array|null
     */
    private $professional_roles;
    /**
     * @var array|null
     */
    private $salary;
    /**
     * @var array|null
     */
    private $employments;
    /**
     * @var array|null
     */
    private $schedules;
    /**
     * @var array|null
     */
    private $education;
    /**
     * @var array|null
     */
    private $language;
    /**
     * @var array|null
     */
    private $experience;
    /**
     * @var string|null
     */
    private $skills;
    /**
     * @var array<string>|null
     */
    private $skill_set;
    /**
     * @var array|null
     */
    private $citizenship;
    /**
     * @var array|null
     */
    private $work_ticket;
    /**
     * @var array|null
     */
    private $travel_time;
    /**
     * @var array|null
     */
    private $recommendation;
    /**
     * @var array|null
     */
    private $resume_locale;
    /**
     * @var array|null
     */
    private $driver_license_types;
    /**
     * @var bool|null
     */
    private $has_vehicle;
    /**
     * @var array|null
     */
    private $hidden_fields;
    /**
     * @var array|null
     */
    private $access;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string|null $last_name
     */
    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string|null $first_name
     */
    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    /**
     * @param string|null $middle_name
     */
    public function setMiddleName(?string $middle_name): void
    {
        $this->middle_name = $middle_name;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }

    /**
     * @param string|null $birth_date
     * @throws UnexpectedValueException
     */
    public function setBirthDate(?string $birth_date): void
    {
        if (
            $birth_date != null
            && DateTime::createFromFormat("Y-m-d", $birth_date) === false
        ) {
            throw new UnexpectedValueException("Birthday must be in Y-m-d format");
        }

        $this->birth_date = $birth_date;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return array|null
     */
    public function getPhoto(): ?array
    {
        return $this->photo;
    }

    /**
     * @param array|null $photo
     */
    public function setPhoto(?array $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return array|null
     */
    public function getPortfolio(): ?array
    {
        return $this->portfolio;
    }

    /**
     * @param array|null $portfolio
     */
    public function setPortfolio(?array $portfolio): void
    {
        $this->portfolio = $portfolio;
    }

    /**
     * @return array|null
     */
    public function getArea(): ?array
    {
        return $this->area;
    }

    /**
     * @param array|null $area
     */
    public function setArea(?array $area): void
    {
        $this->area = $area;
    }

    /**
     * @return array|null
     */
    public function getMetro(): ?array
    {
        return $this->metro;
    }

    /**
     * @param array|null $metro
     */
    public function setMetro(?array $metro): void
    {
        $this->metro = $metro;
    }

    /**
     * @return array|null
     */
    public function getRelocation(): ?array
    {
        return $this->relocation;
    }

    /**
     * @param array|null $relocation
     */
    public function setRelocation(?array $relocation): void
    {
        $this->relocation = $relocation;
    }

    /**
     * @return array|null
     */
    public function getBusinessTripReadiness(): ?array
    {
        return $this->business_trip_readiness;
    }

    /**
     * @param array|null $business_trip_readiness
     */
    public function setBusinessTripReadiness(?array $business_trip_readiness): void
    {
        $this->business_trip_readiness = $business_trip_readiness;
    }

    /**
     * @return array|null
     */
    public function getContact(): ?array
    {
        return $this->contact;
    }

    /**
     * @param array|null $contact
     */
    public function setContact(?array $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return array|null
     */
    public function getSite(): ?array
    {
        return $this->site;
    }

    /**
     * @param array|null $site
     */
    public function setSite(?array $site): void
    {
        $this->site = $site;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return array|null
     */
    public function getSpecialization(): ?array
    {
        return $this->specialization;
    }

    /**
     * @param array|null $specialization
     */
    public function setSpecialization(?array $specialization): void
    {
        $this->specialization = $specialization;
    }

    /**
     * @return array|null
     */
    public function getProfessionalRoles(): ?array
    {
        return $this->professional_roles;
    }

    /**
     * @param array|null $professional_roles
     */
    public function setProfessionalRoles(?array $professional_roles): void
    {
        $this->professional_roles = $professional_roles;
    }

    /**
     * @return array|null
     */
    public function getSalary(): ?array
    {
        return $this->salary;
    }

    /**
     * @param array|null $salary
     */
    public function setSalary(?array $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return array|null
     */
    public function getEmployments(): ?array
    {
        return $this->employments;
    }

    /**
     * @param array|null $employments
     */
    public function setEmployments(?array $employments): void
    {
        $this->employments = $employments;
    }

    /**
     * @return array|null
     */
    public function getSchedules(): ?array
    {
        return $this->schedules;
    }

    /**
     * @param array|null $schedules
     */
    public function setSchedules(?array $schedules): void
    {
        $this->schedules = $schedules;
    }

    /**
     * @return array|null
     */
    public function getEducation(): ?array
    {
        return $this->education;
    }

    /**
     * @param array|null $education
     */
    public function setEducation(?array $education): void
    {
        $this->education = $education;
    }

    /**
     * @return array|null
     */
    public function getLanguage(): ?array
    {
        return $this->language;
    }

    /**
     * @param array|null $language
     */
    public function setLanguage(?array $language): void
    {
        $this->language = $language;
    }

    /**
     * @return array|null
     */
    public function getExperience(): ?array
    {
        return $this->experience;
    }

    /**
     * @param array|null $experience
     */
    public function setExperience(?array $experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return string|null
     */
    public function getSkills(): ?string
    {
        return $this->skills;
    }

    /**
     * @param string|null $skills
     */
    public function setSkills(?string $skills): void
    {
        $this->skills = $skills;
    }

    /**
     * @return array|null
     */
    public function getSkillSet(): ?array
    {
        return $this->skill_set;
    }

    /**
     * @param array|null $skill_set
     */
    public function setSkillSet(?array $skill_set): void
    {
        $this->skill_set = $skill_set;
    }

    /**
     * @return array|null
     */
    public function getCitizenship(): ?array
    {
        return $this->citizenship;
    }

    /**
     * @param array|null $citizenship
     */
    public function setCitizenship(?array $citizenship): void
    {
        $this->citizenship = $citizenship;
    }

    /**
     * @return array|null
     */
    public function getWorkTicket(): ?array
    {
        return $this->work_ticket;
    }

    /**
     * @param array|null $work_ticket
     */
    public function setWorkTicket(?array $work_ticket): void
    {
        $this->work_ticket = $work_ticket;
    }

    /**
     * @return array|null
     */
    public function getTravelTime(): ?array
    {
        return $this->travel_time;
    }

    /**
     * @param array|null $travel_time
     */
    public function setTravelTime(?array $travel_time): void
    {
        $this->travel_time = $travel_time;
    }

    /**
     * @return array|null
     */
    public function getRecommendation(): ?array
    {
        return $this->recommendation;
    }

    /**
     * @param array|null $recommendation
     */
    public function setRecommendation(?array $recommendation): void
    {
        $this->recommendation = $recommendation;
    }

    /**
     * @return array|null
     */
    public function getResumeLocale(): ?array
    {
        return $this->resume_locale;
    }

    /**
     * @param array|null $resume_locale
     */
    public function setResumeLocale(?array $resume_locale): void
    {
        $this->resume_locale = $resume_locale;
    }

    /**
     * @return array|null
     */
    public function getDriverLicenseTypes(): ?array
    {
        return $this->driver_license_types;
    }

    /**
     * @param array|null $driver_license_types
     */
    public function setDriverLicenseTypes(?array $driver_license_types): void
    {
        $this->driver_license_types = $driver_license_types;
    }

    /**
     * @return bool|null
     */
    public function isHasVehicle(): ?bool
    {
        return $this->has_vehicle;
    }

    /**
     * @param bool|null $has_vehicle
     */
    public function setHasVehicle(?bool $has_vehicle): void
    {
        $this->has_vehicle = $has_vehicle;
    }

    /**
     * @return array|null
     */
    public function getHiddenFields(): ?array
    {
        return $this->hidden_fields;
    }

    /**
     * @param array|null $hidden_fields
     */
    public function setHiddenFields(?array $hidden_fields): void
    {
        $this->hidden_fields = $hidden_fields;
    }

    /**
     * @return array|null
     */
    public function getAccess(): ?array
    {
        return $this->access;
    }

    /**
     * @param array|null $access
     */
    public function setAccess(?array $access): void
    {
        $this->access = $access;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return array_filter($vars, function($value) {
            return $value != null;
        });
    }

}
