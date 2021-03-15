<?php

namespace App\Models\Rating\Methods;

interface RatingInterface
{
    public function saverating(array $params): bool;
}
