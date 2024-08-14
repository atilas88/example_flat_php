<?php

declare(strict_types=1);

namespace App\Models;

class ProviderModel extends BaseModel
{
    protected string $table = 'Provider';

    protected array $fields = [
        'id'=>'',
        'field2'=> '',
        'field3' => '',
        'field4' => '',
        'field5' => ''
    ];
}
