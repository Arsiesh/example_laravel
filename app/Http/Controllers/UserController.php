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

        $request->validate([
            'first'=>'required|string|max:50',
            'last'=>'required|string|max:50',
            'phone'=>'required|unique|integer|max:11',
        ]);

        $user = Customer::create(
        [

            "first"=> $request->first,
            "last"=> $request->last,
            "phone"=> $request->phone,
        ]
        );

        if(!$user) {
            return response()->json([
                "type"=> "Error",
                "message" => "Failed",
            ],500);
        }

        return response()->json([
            "type"=> "Success",
            "message" => "User Created Successfully",
        ],200);
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