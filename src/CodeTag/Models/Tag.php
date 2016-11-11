<?php

namespace CodePress\CodeTag\Models;


use Illuminate\Contracts\Validation\Validator;
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

    private $validator;

    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules(['name'=>'required|max:255']);
        $validator->setData( $this->attributes );
        if($validator->fails()){
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }

    public function taggable()
    {
        return $this->morphTo();
    }


}