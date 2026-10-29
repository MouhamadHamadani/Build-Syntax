<?php

namespace App\Models;

use App\Models\Concerns\FlushesCatalogCache;
use Illuminate\Database\Eloquent\Model;

class CatalogPlanFeature extends Model
{
    use FlushesCatalogCache;

    public $timestamps = false;

    protected $fillable = ['plan_id', 'sort_order', 'text'];
}
