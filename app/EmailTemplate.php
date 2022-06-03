<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Email;

class EmailTemplate extends Model
{
    //

    public function getAll()
    {
        $emailTeampltes = EmailTemplate::all();
        return $emailTeampltes;
    }
}
