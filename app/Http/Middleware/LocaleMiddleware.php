<?php

namespace Corp\Http\Middleware;

use Closure;
use App;
use Request;

class LocaleMiddleware
{

//	public static $mainLanguage = 'en'; // default lang in URL
//	public static $languages = []; // availables langs




	public static function getLocale()
	{
		$uri = Request::path(); //пуе  URI


		$segmentsURI = explode('/',$uri);



		if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], getlangsCodes())) {

			if ($segmentsURI[0] != getOption('LANG', 'en'))
				return $segmentsURI[0];

		}


		return null;
	}


	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

   // 	dump($request);

	    $locale = self::getLocale();
	    if($locale) App::setLocale($locale);

	    else App::setLocale(getOption('LANG', 'en'));




	    return $next($request);
    }
}
