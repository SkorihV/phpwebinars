<?php


namespace App\Data\User\Exception;


use App\Exception\AbstractAppException;
use Throwable;

class EmptyFieldException extends AbstractAppException
{
    private $emptyFields = [];

    public function addEmptyField(string $alias)
    {
        if (!in_array($alias, $this->emptyFields)) {
            $this->emptyFields[$alias] = true;
        }
    }

    public function getEmptyFields(): array
    {
        return $this->emptyFields;
    }


}