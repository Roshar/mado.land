<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\People;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {
        $pages = Page::all();
        $portfolios = Portfolio::all();
        $peoples = People::all();
        $services = Service::all();

        //получаем теги
        $tags = DB::table('portfolio')->distinct()->pluck('filter');

        $menu = [];

        foreach ($pages as $page) {
            $item = ['title' => $page->name,'alias' => $page->alias];
            $menu[] = $item;
        }
        $item = ['title' => 'Service','alias' => 'service'];
        $menu[] = $item;

        $item = ['title' => 'Portfolio','alias' => 'Portfolio'];
        $menu[] = $item;

        $item = ['title' => 'Clients','alias' => 'clients'];
        $menu[] = $item;

        $item = ['title' => 'Team','alias' => 'team'];
        $menu[] = $item;

        $item = ['title' => 'Contact','alias' => 'contact'];
        $menu[] = $item;


        return view('site.index',  ['menu' => $menu,
                                         'pages' => $pages,
                                         'portfolio' => $portfolios,
                                         'service' => $services,
                                         'team' => $peoples,
                                         'tags' => $tags]);
    }
}
