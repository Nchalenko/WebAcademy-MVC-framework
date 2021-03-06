<?php

namespace Service\Cast;

use Model\Cast;
use Service\Base;
use Service\Validator;
use Service\X;

class Delete extends Base
{
    public function validate($params)
    {
        $rules = [
            'Id'    => ['required', 'positive_integer'],
        ];

        return Validator::validate($params, $rules);
    }

    public function execute($params)
    {
        $cast = Cast::findById($params['Id']);
        if (!$cast) {
            throw new X([
                'Type'    => 'FORMAT_ERROR',
                'Fields'  => ['Id' => 'WRONG'],
                'Message' => 'Cast does not exists'
            ]);
        }

        if (!Cast::delete(['Id' => [$params['Id']]])) {
            throw new X([
                'Type'    => 'FORMAT_ERROR',
                'Fields'  => ['Id' => 'WRONG'],
                'Message' => 'Cannot delete a cast'
            ]);
        }

        return [
            'Status'    => 1,
        ];
    }
}
