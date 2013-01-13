<?php
namespace Melody\Validation\Constraints;

class Max extends Constraint
{
    protected $id = 'max';
    private $max;

    public function __construct($max)
    {
        $this->max = $max;
    }

    public function validate($input)
    {
        return is_numeric($input) && $input <= $this->max;
    }

    public function getErrorMessageTemplate()
    {
        return "The input '{{input}}' must be greater than {$this->max}";
    }
}
