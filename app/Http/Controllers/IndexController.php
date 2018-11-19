<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Service;
use App\People;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {

        if ($request->isMethod('post')) {

            $message = [
                'required' => 'Поля :attribute обязательно заполнить',
                'email' => ':attribute некорректный email адрес'
            ];

         $this->validate($request,[
             'name' => 'required|max:255',
             'email' => 'required|email',
             'text' => 'required'
         ],$message);
        }

        $data = $request->all();

        $result = Mail::send('site.email',['data' => $data], function ($message) use ($data) {
            $mail_admin = 'webrush@mail.ru';
            $message->from($data['email'],$data['name']);
            $message->to($mail_admin)->subject('Тема');
        });
        if ($result) {
            return redirect()->route('home')->with('status','Email is send');
        }


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
