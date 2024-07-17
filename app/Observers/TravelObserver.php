<?php

namespace App\Observers;

use App\Models\Travel;

class TravelObserver
{
    /**
     * Handle the Travel "creating" event.
     */
    public function creating(Travel $travel): void
    {
        $travel->slug = str($travel->name)->slug();
    }


}
