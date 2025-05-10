<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;

class BabysitterSearchController extends Controller
{
    public function searchRedirect()
    {
        return view('babysitter/search_redirect');
    }
    public function search()
    {
        //
        $paginator = Babysitter::with(["services"])->paginate();
        //
        return view('babysitter/search_search',[
            "paginator" => $paginator,
        ]);
    }
    public function searchSubmit()
    {

    }
}
