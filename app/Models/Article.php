<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\ModelStatus\HasStatuses;

class Article extends Model
{
    use HasUlids, HasStatuses;

    protected $fillable = [
        'title',
    ];



}