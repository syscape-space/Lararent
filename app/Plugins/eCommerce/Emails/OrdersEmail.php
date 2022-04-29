<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 19:22
 */

namespace Corp\Plugins\eCommerce\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdersEmail extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * The demo object instance.
	 *
	 * @var Demo
	 */
	//public $to = ['3@gmail.com'];
	public $request;
	public $orderId;
	public $emailNewOrder;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( $request, $order ) {
		$this->request = $request;
		$this->order = $order;
		$this->emailNewOrder = new EmailNewOrder();

	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {

		$orderId = $this->orderId;
		$subject = str_ireplace( [ '{site_title}', '{order_date}', '{order_number}' ],
			[ getOption( 'blogname', $this->order->created_at ?? '', $this->order->id ?? '' ) ],
			$this->emailNewOrder->subject );

		return $this->subject( $subject )
		            ->from( getOption( 'admin_email' ) )
		            ->to( $this->emailNewOrder->recipients )
		            ->view( 'plugin:eCommerce::emails.new_order' )->with( compact( 'orderId' ) )

//			->attachData( $pdf->stream('invoice.pdf'), 'invoice.pdf', [
//				'mime' => 'application/pdf',
//			])
			;

	}
}