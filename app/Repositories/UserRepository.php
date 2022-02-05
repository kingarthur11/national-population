<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version December 13, 2021, 9:56 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'name',
        'password',
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
        return User::class;
    }

    public function getByEmail($email) 
    {
        return User::where('email',  "=", $email)->latest()->first();
    }
    public function createUser(array $UserDetails) 
    {
        return User::create($UserDetails);
    }

    

    public function getAllUsers() 
    {
        return User::all();
    }

    public function getUserById($UserId) 
    {
        return User::findOrFail($UserId);
    }

}