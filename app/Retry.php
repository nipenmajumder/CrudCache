<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retry extends Model
{
    protected $table = 'retries';
    protected $primaryKey = 'r_id';
    protected $fillable = ['name', 'roll'];

    public function validation()
    {
        return [

            'name' => 'required',
            'roll' => 'required'

        ];
    }


    protected $dispatchesEvents = [
        'created' => \App\Events\DataSave::class,
        'updated' => \App\Events\DataUpdate::class,
        'deleted' => \App\Events\DataDelete::class,
    ];
}
