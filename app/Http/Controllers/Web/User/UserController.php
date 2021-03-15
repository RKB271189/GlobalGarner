<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\User\Methods\UserInterface;

//use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $issuccess = true;
    public function __construct(UserInterface $userInterface)
    {
        $this->userRepository = $userInterface;
    } 
}
