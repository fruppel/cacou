<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = ['user_id', 'weight', 'created_at'];

    public function getGraphData(int $days)
    {
        $data = Weight::select('created_at as x', 'weight as y')
            ->orderBy('created_at')
            ->where('user_id', auth()->id());

        if ($days) {
            $data->where('created_at', '>', Carbon::now()->subDays($days));
        }

        $data = $data->get();

        $maxWeight = $data->max('y');
        $minWeight = $data->min('y');

        return compact('data', 'minWeight', 'maxWeight');
    }

}
