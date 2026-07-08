<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'completed'])]
class Item extends Model
{
    protected function casts(): array
    {
        return [
            'completed' => 'boolean',
        ];
    }
}
