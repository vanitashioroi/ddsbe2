<?php

// Change namespace to App\Models if you put your model inside models
namespace App\Models;

use Illuminate\Database\Eloquent\Model;  // Library to create Model in Lumen

class UserJob extends Model
{
    // Name of the table
    protected $table = 'tbluserjob';

    // Columns in the table
    protected $fillable = [
        'jobid',
        'jobname',
    ];

    // This code will not require the fields `created_at` and `updated_at` in Lumen
    public $timestamps = false;

    // This code customizes your primary key field name, default in Lumen is `id`
    protected $primaryKey = 'jobid';
}
