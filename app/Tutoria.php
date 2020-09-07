<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the table has timestamps.
     * 
     * @var bool
     */
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['user_id', 'tutor_id', 'type'];
}
