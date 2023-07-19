<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RootUrlAtlas extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'root_url_atlas';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'keywords' => 'array',
        'domain_details' => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $Dates
     */
    protected $Dates = [
        'updated_at',
        'created_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'title',
        'favicon',
        'keywords',
        'updated_at',
        'created_at',
        'modified_at',
        'description',
        'domain_details'
    ];   
}
