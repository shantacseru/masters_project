<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category ;
use App\Item ;

class WelcomeController extends Controller
{
    
    public function index(){
      
        $categories = DB::table('categories')
        					->where('categories.status', '=', '1')
        					->get();

        $categoriesItems = DB::table('categories')
                                ->join('items', 'categories.id', '=', 'items.category_id')
                                ->where('items.status', '=', '1')
                                ->where('categories.status', '=', '1')
                                ->orderBy('items.popularity', 'desc')
                                ->get(array('categories.name as category', 'items.*'));
                                
        return view('welcome', compact('categories', 'categoriesItems'));
    }
}
