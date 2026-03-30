<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'identification','email','extra', 'contact_general_id','choices'])]
class ContactCompany extends Model
{

    // public $timestamps = false;
    // protected $fillable = ['name', 'identification','email','extra', 'contact_general_id','choices'];
    public function general(){
        return $this->belongsTo(ContactGeneral::class,'contact_general_id');
    }
}
