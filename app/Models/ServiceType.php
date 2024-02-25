<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use SolutionForest\FilamentTree\Concern\ModelTree;

class ServiceType extends Model
{
    use HasFactory, SoftDeletes, ModelTree;

    protected $fillable = ["parent_id", "name", "order"];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
