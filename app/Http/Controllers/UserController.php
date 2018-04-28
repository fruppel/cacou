<?php

namespace App\Http\Controllers;

use App\CaloricRequirementCalculator;
use App\User;

class UserController extends Controller
{
    public function show(User $user, CaloricRequirementCalculator $crc)
    {
       $bmr = $crc->calculate($user);

        return view('users.show', [
            'user' => $user,
            'bmr' => $bmr,
        ]);
    }
}
