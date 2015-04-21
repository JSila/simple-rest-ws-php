<?php

namespace App;

class User extends Model
{
    /**
     * Get a single user.
     *
     * @param $id
     * @return Collection
     */
    public function find($id)
    {
        $user = $this->select('users', $id);

        if (in_array('country', $this->with)) {
            $user['country'] = $this->select('countries', $user['countryId']);
            unset($user['countryId']);
        }

        return new Collection($user);
    }
}
