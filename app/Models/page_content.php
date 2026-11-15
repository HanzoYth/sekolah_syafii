<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class page_content extends Model
{
    protected $table = 'page_contents';

    protected $fillable = [
        'page_key',
        'content_json',
        'updated_by',
    ];
}
