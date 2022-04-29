<?php

namespace Corp\Themes\RentIt\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * The demo object instance.
	 *
	 * @var Demo
	 */
	public $request;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($request)
	{
		$this->request = $request;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{

		return $this->subject($this->request->subject ?? __('Demo Form:  Contact form submitted'))->from($this->request->email )
		            ->view('theme:rentit::emails.demo')
		            ;
	}
}
