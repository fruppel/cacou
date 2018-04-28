<?php

namespace App;

class CaloricRequirementCalculator
{
    public function calculate(User $user)
    {
        return ($this->calculateMifflinStJeor($user) + $this->calculateHarrisBenedict($user)) / 2;
    }

    private function calculateHarrisBenedict(User $user)
    {
        if ($user->gender === User::GENDER_MALE) {
            return 66.47 + (13.7 * $user->weight) + (5 * $user->height) - (6.8 * $user->age);
        }

        return 655.1 + (9.6 * $user->weight) + (1.8 * $user->height) - (4.7 * $user->age);
    }

    private function calculateMifflinStJeor(User $user)
    {
        $genderModificator = $user->gender === User::GENDER_MALE ? 5 : -161;

        return 10 * $user->weight + 6.25 * $user->height - 5 * $user->age + $genderModificator;
    }
}