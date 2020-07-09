<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crud extends Model
{
    protected $table = 'cruds';
    protected $primaryKey = 'crud_id';
    protected $fillable = ['name', 'department'];

    public function validation()
    {
        return [

            'name' => 'required',
            'department' => 'required'

        ];
    }


    protected $dispatchesEvents = [
        'created' => \App\Events\DataSave::class,
        'updated' => \App\Events\DataUpdate::class,
        'deleted' => \App\Events\DataDelete::class,
    ];
}
