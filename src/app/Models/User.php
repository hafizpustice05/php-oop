<?php

namespace App\Models;

use App\Bootstrap\Model;

class User extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find()
    {
        $statement = 'select * from user';

        return $this->db->query($statement);
    }
}
