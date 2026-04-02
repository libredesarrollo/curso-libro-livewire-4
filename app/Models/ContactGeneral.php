<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['subject', 'message', 'type'])]
class ContactGeneral extends Model
{
    // protected $fillable = ['subject','message','type'];
    public function person()
    {
        return $this->hasOne(ContactPerson::class);
    }

    public function company()
    {
        return $this->hasOne(ContactCompany::class);
    }

    public function detail()
    {
        return $this->hasOne(ContactDetail::class);
    }
}
