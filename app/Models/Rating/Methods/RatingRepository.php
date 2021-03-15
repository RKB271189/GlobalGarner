<?php

namespace App\Models\Rating\Methods;

use App\Models\BaseMethods\BaseRepository;
use App\Models\Rating\rating;

class RatingRepository extends BaseRepository implements RatingInterface
{

    public function __construct(rating $rating)
    {
        parent::__construct($rating);
        $this->model = $rating;
    }
    public function saverating(array $params): bool
    {
        try {
            return $this->InsertNewRecord($params);
        } catch (RatingException $ex) {
            $this->StoreException($ex);
            return false;
        }
    }
}
