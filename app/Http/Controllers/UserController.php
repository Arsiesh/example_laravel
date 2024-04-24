<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = $request?->username;
        $first = $request?->first;
        $last = $request?->last;
        $phone = $request?->phone;     
    

    }
}