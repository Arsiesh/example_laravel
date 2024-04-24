<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Customer;
class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  store
    //  update
    //  delete
    //  show/{id}
    //  show-all
    public function store(Request $request)
    {


        $user = Customer::create($request->all());
        $user->store([
            "first"=> $request->first,
            "last"=> $request->last,
            "phone"=> $request->phone,
        ]);
        // $username = $request?->username;
        // $first = $request?->first;
        // $last = $request?->input('last');
        // $phone = $request?->input('phone');     

    }


    public function update(Request $request, $id)
    {
        $user = Customer::findOrFail($id);

        $user->update([
            "first"=> $request->first,
            "last"=> $request->last,
            "phone"=> $request->phone,
        ]);

        // $user->username = $request->input('username', $user->username);
        // $user->first = $request->input('first', $user->first);
        // $user->last = $request->input('last', $user->last);
        // $user->phone = $request->input('phone', $user->phone);

        $user->save();
    }

    public function destroy($id){
        $user = Customer::findOrFail($id);
        $user->delete();
    }

    public function show($id){
        $user = Customer::findOrFail($id);
        return response()->json($user);
    }

    public function showAll(){
        $user = Customer::all();
        return response()->json($user);
    }
}