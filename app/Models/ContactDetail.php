<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['extra', 'contact_general_id'])]
class ContactDetail extends Model
{
    // public $timestamps = false;
    // protected $fillable = ['extra','contact_general_id'];
    public function general()
    {
        return $this->belongsTo(ContactGeneral::class, 'contact_general_id');
    }
}
