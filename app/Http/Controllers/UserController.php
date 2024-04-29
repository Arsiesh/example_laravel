<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
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
        $validation = $this->validateCustomer($request, 'customer');

        if ($validation->fails()) {
            return response()->json([
                "type" => "Error",
                "message" => "Validation failed",
                "errors" => $validation->errors(),
            ], 422);
        }

        // Proceed with creating the user
        $user = Customer::create([
            "first" => $request->input("first"),
            "last" => $request->input("last"),
            "phone" => $request->input("phone"),
        ]);

        if (!$user) {
            return response()->json([
                "type" => "Error",
                "message" => "Failed to create user",
            ], 500);
        }

        return response()->json([
            "type" => "Success",
            "message" => "User Created Successfully",
        ], 200);
    }


    public function update(Request $request, $id)
    {
        
        $validation = $this->validateCustomer($request, 'update');

        if ($validation->fails()) {
            return response()->json([
                "type" => "Error",
                "message" => "Validation failed",
                "errors" => $validation->errors(),
            ], 422);
        }

        $user = Customer::findOrFail($id);
        $user->update([
            "first"=> $request->first,
            "last"=> $request->last,
            "phone"=> $request->phone,
        ]);

        $user->save();
    }

    public function destroy(Request $request){
        $validation = $this->validateCustomer($request, 'id');

        if ($validation->fails()) {
            return response()->json([
                "type" => "Error",
                "message" => "Validation failed",
                "errors" => $validation->errors(),
            ], 422);
        }

        $id = $request->input("id");
        $user = Customer::findOrFail($id);
        $user->delete();
        return response()->json([
            "type" => "Success",
            "message" => "User Deleted Successfully!",
        ], 200);
    }

    public function show(Request $request){
        $id = $request->input("id");

        $validation = $this->validateCustomer($request, 'id');

        if ($validation->fails()) {
            return response()->json([
                "type" => "Error",
                "message" => "Validation failed",
                "errors" => $validation->errors(),
            ], 422);
        }
        $user = Customer::findOrFail($id);
        return response()->json($user);
    }

    public function showAll(){
        $user = Customer::all();
        return response()->json($user);
    }
    private function validateCustomer(Request $request, $type)
    {
        $getCustomer = Validator::make($request->all(), [
            'first' => 'required|max:50',
            'last' => 'required|max:50',
            'phone' => 'required|unique:customers|max:11',
        ]);

        $getID = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        $updateTable = Validator::make($request->all(), [
            'first' => 'required|max:50',
            'last' => 'required|max:50',
            'phone' => 'required|unique:customers|max:11',
            'id' => 'required|integer',
        ]);

        switch($type){
            case 'customer':
                return $getCustomer;
            case 'id':
                return $getID;
            case 'update':
                return $updateTable;
        }


    }

}