<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.09.2018
 * Time: 13:33
 */

namespace Corp\Themes\RentIt\Customize;


class CustomizerInit {


	public function __construct() {

		$Customize = app()->make( 'CustomizeManager' );

		$Customize
			->setPanels( 'header_panel', array(
				'title' => __( 'Header' ),
				'priority' => 31,
				'description' => ''
			) )
			->setControl( 'header_logo', array(
				'label' => __( 'Select logo' ),
				'panel' => 'header_panel',
				'default' => '',
				'type' => 'mediaImg'
			) )
			->setControl( new SocialButtonsHeader( $Customize, 'rentit_header_icons', array(
				'label' => __( 'Header social icons' ),
				'panel' => 'header_panel',
				'default' => '',
				'description' => __( 'you can dynamic add new social buttons in header' ),
				'type' => 'textarea'
			) ) )
			/**
			 * Google map
			 */
			->setPanels( 'google_panel', array(
				'title' => __( 'Google map options' ),
				'priority' => 31,
				'description' => ''
			) )
			->setControl( 'google_api_key', array(
				'label' => __( 'Insert google map api key' ),
				'panel' => 'google_panel',
				'default' => '',
				'description' => __( '(see https://developers.google.com/maps/documentation/javascript/get-api-key#key )' ),
				'type' => 'text'
			) )
			/**
			 * Performance
			 */
			->setPanels( 'performance_panel', array(
				'title' => __( 'Performance' ),
				'priority' => 31,
				'description' => ''
			) )
			->setControl( 'rentit_enable_preloader', array(
				'label' => __( 'Enable preloader?' ),
				'panel' => 'performance_panel',
				'default' => true,
				'type' => 'checkbox'
			) )
			/**
			 * Footer panel
			 */
			->setPanels( 'footer_panel', array(
				'title' => __( 'Footer' ),
				'priority' => 31,
				'description' => ''
			) )
			->setControl( 'footer_copyright', array(
				'label' => __( 'footer copyright' ),
				'panel' => 'footer_panel',
				'default' => '©' . date( 'Y', time() ) . '  Rent It — An One Page Rental Car Theme made with passion by jThemes Studio',
				//'section' => 'panel_logo_type_2',
				'type' => 'textarea'
			) )
			->setControl( 'footer_enable_social_buttons', array(
				'label' => __( 'Enable footer social buttons?' ),
				'panel' => 'footer_panel',
				'default' => true,

				'type' => 'checkbox'
			) )
			->setControl( new SocialButtons( $Customize, 'footer_social_buttons', array(
				'label' => __( 'footer social buttons' ),
				'panel' => 'footer_panel',
				'default' => '©' . date( 'Y', time() ) . '  Rent It — An One Page Rental Car Theme made with passion by jThemes Studio',
				'description' => __( 'you can dynamic add new social buttons in footer' ),
				'type' => 'textarea'
			) ) )
			/*
			 * Rent It Options
			 */
			->setPanels( 'rent_it_options', array(
				'title' => __( 'RentIt Options' ),
				'priority' => 31,
				'description' => ''
			) )
			// add calendar section
			->setSection( 'rent_it_options_calendar', array(
				'title' => __( 'Calendar' ),
				'priority' => 31,
				'panel' => 'rent_it_options',
				'description' => ''
			) )
			->setControl( 'rentit_calendar_format', array(
				'label' => __( 'calendar format' ),
				//'panel' => 'panel_logo_type',
				'default' => 'DD-MM-YYYY',
				'section' => 'rent_it_options_calendar',
				'type' => 'select',

				'choices' => array(
					'MM/DD/YYYY ' => __( 'MM/DD/YYYY ' ),
					'DD-MM-YYYY' => __( 'DD-MM-YYYY' ),


				)
			) )

			->setSection( 'rent_it_options_booking', array(
				'title' => __( 'Booking' ),
				'priority' => 31,
				'panel' => 'rent_it_options',
			) )
			->setControl( 'rentit_booking_cancel', array(
				'label' => __( 'Allow user cancel orders' ),
				'default' => true,
				'section' => 'rent_it_options_booking',
				'type' => 'checkbox',

			) )



			// add time section
			->setSection( 'rent_it_options_time', array(
				'title' => __( 'Time Options' ),
				'priority' => 31,
				'panel' => 'rent_it_options',
			) )
			->setControl( new TimeOptions( $Customize, 'rent_it_options_time', array(
				'label' => __( 'add hours in your format' ),
				'section' => 'rent_it_options_time',
				'description' => __( 'you can dynamic add new social buttons in footer' ),
				'type' => 'textarea'
			) ) )
			// product list
			->setSection( 'rent_it_options_product_list', array(
				'title' => __( 'Product list' ),
				'priority' => 31,
				'panel' => 'rent_it_options',
				'description' => ''
			) )
			->setControl( 'rentit_product_display', array(
				'label' => __( 'How many display product per page?' ),
				'default' => 6,
				'section' => 'rent_it_options_product_list',
				'type' => 'number',

			) )
			->setControl( 'rentit_rent_it', array(
				'label' => __( 'Rent It (button text)' ),
				'default' => __( 'Rent It' ),
				'section' => 'rent_it_options_product_list',
				'type' => 'text',

			) )
			->setControl( 'rentit_product_list_price_format', array(
				'label' => __( 'Product price format' ),
				'default' => __( 'Start from %price% /per a day' ),
				'section' => 'rent_it_options_product_list',
				'type' => 'text',
				'description' => __( 'use %price% to display product price' )

			) )
			->setControl( 'rentit_catalog_orderby', array(
				'label' => __( 'Default product sorting' ),
				'default' => 'price',
				'section' => 'rent_it_options_product_list',
				'type' => 'select',
				'choices' => [
					'price' => __( 'Sort by price (asc)' ),
					'price-desc' => __( 'Sort by price (desc)' ),
					'date' => __( 'Sort by most recent' ),
				],
				'description' => __( 'How should products be sorted in the catalog by default?' )

			) )
			/**
			 *
			 */


			/*
			 * Rent It Email options
			 */
			->setPanels( 'rent_it_email', array(
				'title' => __( 'RentIt Email options' ),
				'priority' => 31,
				'description' => ''
			) )
			->setControl( 'rentit_email_to', array(
				'label' => __( 'Send emails to?' ),
				'default' => '',
				'panel' => 'rent_it_email',
				'description' => __( 'for example (1@gmails.com, 2@gmail.com)' ),
				'type' => 'text',

			) )
			/**
			 * Subscribe form
			 */
			->setPanels( 'rent_it_MailChimp', array(
				'title' => __( 'MailChimp / Subscriber forms' ),
				'priority' => 31,
				'description' => __( 'Specify api key and ID list' )
			) )
			->setControl( 'rent_it_MailChimp_id', array(
				'label' => __( 'ID list' ),
				'default' => '',
				'panel' => 'rent_it_MailChimp',
				'description' => '',
				'type' => 'text',

			) )
			->setControl( 'rent_it_MailChimp_key', array(
				'label' => __( 'API key' ),
				'default' => '',
				'panel' => 'rent_it_MailChimp',
				'description' => '',
				'type' => 'text',

			) )
			// rentit blog
			->setPanels( 'rentit_blog_options', array(
				'title' => __( 'Blog options' ),
				'priority' => 31,
				'description' => __( 'Blog options' )
			) )
			->setControl( 'rentit_sidebar_position', array(
				'label' => __( 'Sidebar position' ),
				'default' => '',
				'panel' => 'rentit_blog_options',
				'description' => '',
				'type' => 'select',

				'choices' => array(
					'left' => __( 'left' ),
					'right' => __( 'right' ),
					'hide' => __( 'hide' ),


				)

			) )
			// rentit portfolio
			->setPanels( 'rentit_portfolio_options', array(
				'title' => __( 'Portfolio options' ),
				'priority' => 31,
				'description' => __( 'Blog options' )
			) )
			->setControl( 'rentit_portfolio_count_per_page', array(
				'label' => __( 'Home many display portfolio per page' ),
				'default' => 8,
				'panel' => 'rentit_portfolio_options',
				'description' => '',
				'type' => 'number',

			) )
			/**
			 * rentit coming soon mode
			 */
			->setPanels( 'rentit_coming_soon_mode', array(
				'title' => __( 'Сoming soon' ),
				'priority' => 31,
				'description' => __( 'coming soon mode options' )
			) )
			->setControl( 'rentit_coming_soon_mode_title', array(
				'label' => __( 'Title' ),
				'default' => __( 'COMING SOON' ),
				'panel' => 'rentit_coming_soon_mode',
				'description' => '',
				'type' => 'text',


			) )
			->setControl( 'rentit_rent_it_coming_soon', array(
				'label' => __( 'Enable coming soon mode?' ),
				'default' => false,
				'panel' => 'rentit_coming_soon_mode',
				'type' => 'checkbox',
				'color' => 'red'

			) )
			->setControl( 'rentit_coming_soon_mode_date', array(
				'label' => __( 'Open date' ),
				'panel' => 'rentit_coming_soon_mode',
				'description' => __( 'You can put date in this format 12/30/2018' ),
				'type' => 'text',


			) )
			/**
			 * rentit  Auth social
			 */
			->setPanels( 'rentit_social_networks', array(
				'title' => __( 'Social Networks' ),
				'priority' => 31,
				'description' => __( 'coming soon mode options' )
			) )
			->setControl( 'rentit_fb_app_id', array(
				'label' => __( 'Facebook App ID' ),
				'panel' => 'rentit_social_networks',
				'description' => __( 'Facebook App ID (get it developers.facebook.com, don\'t  forget  add to  Valid OAuth Redirect URIs
your site url and   https://site.com/fb-callback/ )' ),
				'type' => 'text',


			) )
			->setControl( 'rentit_fb_app_secret', array(
				'label' => __( 'Facebook App Secret' ),
				'panel' => 'rentit_social_networks',
				'description' => __( 'Facebook App Secret (get it developers.facebook.com)' ),
				'type' => 'text',


			) )
			->setControl( 'rentit_tw_app_id', array(
				'label' => __( 'Twitter App ID' ),
				'panel' => 'rentit_social_networks',
				'description' => __( 'Twitter App ID (get it https://developer.twitter.com/, don\'t  forget  add to  Valid OAuth Redirect URIs
your site url and   https://site.com/tw-callback )' ),
				'type' => 'text',


			) )
			->setControl( 'rentit_tw_app_secret', array(
				'label' => __( 'Twitter App Secret' ),
				'panel' => 'rentit_social_networks',
				'description' => '',
				'type' => 'text',


			) );
	}
}