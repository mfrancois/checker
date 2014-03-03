<?php

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function showWelcome()
    {
        //dd(CssSelector::toXPath('a'));

        $crawler = new Crawler();
        $crawler->addContent(file_get_contents('http://distilleri.es/'));
        //dd($doc);


        foreach ($crawler->filter('a') as $key => $value)
        {
            $link = $value->getAttribute('href');

        }

        foreach ($crawler->filter('img') as $key => $value)
        {
            $link = $value->getAttribute('src');

        }

        return View::make('hello');
    }

}