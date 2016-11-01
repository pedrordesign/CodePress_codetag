<?php

namespace CodePress\CodeTag\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'codepress_tags';


    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'active'
    ];


}