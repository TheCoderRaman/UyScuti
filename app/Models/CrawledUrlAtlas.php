<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrawledUrlAtlas extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crawled_url_atlas';

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
        'status',
        'updated_at',
        'created_at',
        'modified_at',
        'sub_url_id'
    ];
}
