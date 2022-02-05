<?php

namespace App\Repositories;

use App\Models\LGA;
use App\Models\Citizen;
use App\Models\State;
use App\Models\Ward;
use App\Repositories\BaseRepository;

/**
 * Class CitizenRepository
 * @package App\Repositories
 * @version December 13, 2021, 9:56 pm UTC
*/

class CitizenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'state_id',

        'lga_id',
        
        'name',
        'gender',
        'address',
        'phone_no',
        'ward_id',
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Citizen::class;
    }

    public function model()
    {
        return LGA::class;
    }

    public function model()
    {
        return State::class;
    }

    public function model()
    {
        return Ward::class;
    }

    public function getByPhoneNo($phone_no) 
    {
        return Citizen::where('phone_no',  "=", $phone_no)->latest()->first();
    }
    public function createCitizen(array $CitizenDetails) 
    {
        return Citizen::create($CitizenDetails);
    }
    public function createstate(array $stateDetails) 
    {
        return State::create($stateDetails);
    }
    public function createlga(array $lgaDetails) 
    {
        return LGA::create($lgaDetails);
    }
    public function createward(array $wardDetails) 
    {
        return Ward::create($wardDetails);
    }
    
    public function getcitizins(array $wardDetails) 
    {
        return Ward::create($wardDetails);
    }

    public function getallCitizenInWard() 
    {
        return $loanHistory = DB::table('citizens')
                        ->join('wards', 'wards.id', '=', 'citizens.ward_id')
                        ->select(
                            'citizens.id',
                            'citizens.gender',
                            'citizens.address',
                            'citizens.phone_no',
                            'wards.name',
                            )
                        ->get();
    }
    public function getallCitizenInLga() 
    {
        return $loanHistory = DB::table('citizens')
                        ->join('wards', 'wards.id', '=', 'citizens.ward_id')
                        ->join('l_g_a_s', 'l_g_a_s.id', '=', 'wards.lga_id')
                        ->select(
                            'citizens.id',
                            'citizens.gender',
                            'citizens.address',
                            'citizens.phone_no',
                            'wards.name',
                            'l_g_a_s.name',
                            )
                        ->get();
    }
    public function getallCitizenInState() 
    {
        return $loanHistory = DB::table('citizens')
                        ->join('wards', 'wards.id', '=', 'citizens.ward_id')
                        ->join('l_g_a_s', 'l_g_a_s.id', '=', 'wards.lga_id')
                        ->join('states', 'states.id', '=', 'l_g_a_s.state_id')
                        ->select(
                            'citizens.id',
                            'citizens.gender',
                            'citizens.address',
                            'citizens.phone_no',
                            'wards.name',
                            'states.name',
                            )
                        ->get();
    }

}   