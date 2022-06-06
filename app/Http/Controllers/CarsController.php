<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarsResource;
use App\Models\Cars;

class CarsController extends Controller
{
    public function getCars()
    {
       return CarsResource::collection(Cars::all());
    }

}
