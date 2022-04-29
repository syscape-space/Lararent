<?php

namespace Corp\Listeners;

use Corp\Events\onEmailSend;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSend
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  onEmailSend  $event
     * @return void
     */
    public function handle(onEmailSend $event)
    {
    	return $event;
        //
    }
}
