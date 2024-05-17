<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Store
    // Update
    // Delete
    // Show/{id}
    // Show-all

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

    /**
     * @OA\Post(
     * path="/customers/create-new",
     * summary="Create",
     * description="New User",
     * operationId="create",
     * tags={"Example"},
     * @OA\RequestBody(
     *      required=true,
     *      description="blabla",
     *      @OA\JsonContent(
     *          @OA\Property(property="first", type="string", format="string", example="Juan"),
     *          @OA\Property(property="last", type="string", format="string", example="Dela Cruz"),
     *          @OA\Property(property="phone", type="string", format="string", example="09178882222"),
     *      ),
     * ),
     * 
     * @OA\Response(
     *   response=200,
     *   description="User Created Successfully",
     *   @OA\JsonContent(
     *      @OA\Property(property="message", type="string")
     *   )
     * ),
     * @OA\Response(
     *    response=500,
     *    description="Failed to create User",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *        )
     *     )
     * 
     * )
     */
    public function store(Request $request)
    {
        $validation = $this->validateCustomer($request, 'customer');
        $this->validationCheck($validation);

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

    /**
     * @OA\Put(
     * path="/customers/update",
     * summary="Update",
     * description="Update User",
     * operationId="Update",
     * tags={"Example"},
     * @OA\RequestBody(
     *      required=true,
     *      description="blabla",
     *      @OA\JsonContent(
     *          @OA\Property(property="first", type="string", format="string", example="Juan"),
     *          @OA\Property(property="last", type="string", format="string", example="Dela Cruz"),
     *          @OA\Property(property="phone", type="string", format="string", example="09178882222"),
     *      ),
     * ),
     * 
     * @OA\Response(
     *   response=200,
     *   description="User Updated Successfully",
     *   @OA\JsonContent(
     *      @OA\Property(property="message", type="string")
     *   )
     * ),
     * @OA\Response(
     *    response=500,
     *    description="Failed to update User",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *        )
     *     )
     * )
     */
    public function update(Request $request)
    {
        $id = $request->input("id");
        $validation = $this->validateCustomer($request, 'updates');
        $user = Customer::findOrFail($id);
        $this->validationCheck($validation);

        $user->update([
            "first" => $request->input("first"),
            "last" => $request->input("last"),
            "phone" => $request->input("phone"),
        ]);

        $user->save();

        if (!$user) {
            return response()->json([
                "type" => "Error",
                "message" => "Failed to update user",
            ], 500);
        }

        return response()->json([
            "type" => "Success",
            "message" => "User Updated Successfully",
        ], 200);
    }

    /**
     * @OA\Delete(
     * path="/customers/delete",
     * summary="Delete",
     * description="Delete User",
     * operationId="delete",
     * tags={"Example"},
     * @OA\RequestBody(
     *      required=true,
     *      description="blabla",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="integer", format="int64", example=1),
     *      ),
     * ),
     * @OA\Response(
     *   response=200,
     *   description="User Deleted Successfully",
     *   @OA\JsonContent(
     *      @OA\Property(property="message", type="string")
     *   )
     * ),
     * @OA\Response(
     *    response=500,
     *    description="Failed to delete User",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *        )
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $validation = $this->validateCustomer($request, 'id');
        $this->validationCheck($validation);

        $id = $request->input("id");
        $user = Customer::findOrFail($id);
        $user->delete();
        return response()->json([
            "type" => "Success",
            "message" => "User Deleted Successfully!",
        ], 200);
    }

    /**
     * @OA\Get(
     * path="/customers/show",
     * summary="Show",
     * description="Show User",
     * operationId="show",
     * tags={"Example"},
     * @OA\RequestBody(
     *      required=true,
     *      description="blabla",
     *      @OA\JsonContent(
     *          @OA\Property(property="id", type="integer", format="int64", example=1),
     *      ),
     * ),
     * @OA\Response(
     *   response=200,
     *   description="User Retrieved Successfully",
     *   @OA\JsonContent(
     *      @OA\Property(property="first", type="string"),
     *      @OA\Property(property="last", type="string"),
     *      @OA\Property(property="phone", type="string"),
     *   )
     * ),
     * @OA\Response(
     *    response=404,
     *    description="User not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *        )
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->input("id");
        $validation = $this->validateCustomer($request, 'id');
        $this->validationCheck($validation);

        $user = Customer::findOrFail($id);
        return response()->json($user);
    }

    /**
     * @OA\Get(
     * path="/customers/show-all",
     * summary="Show All",
     * description="Show All Users",
     * operationId="showAll",
     * tags={"Example"},
     * @OA\Response(
     *   response=200,
     *   description="Users Retrieved Successfully",
     *   @OA\JsonContent(type="array", @OA\Items(
     *      @OA\Property(property="id", type="integer"),
     *      @OA\Property(property="first", type="string"),
     *      @OA\Property(property="last", type="string"),
     *      @OA\Property(property="phone", type="string"),
     *   ))
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Users not found",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string")
     *        )
     *     )
     * )
     */
    public function showAll()
    {
        $user = Customer::all();
        return response()->json($user);
    }

    private function validateCustomer(Request $request, $type)
    {
        switch ($type) {
            case 'customer':
                return Validator::make($request->all(), [
                    'first' => 'required|max:50',
                    'last' => 'required|max:50',
                    'phone' => 'required|unique:customers|max:11',
                ]);
            case 'id':
                return Validator::make($request->all(), [
                    'id' => 'required|integer',
                ]);
            case 'updates':
                return Validator::make($request->all(), [
                    'first' => 'required|max:50',
                    'last' => 'required|max:50',
                    'phone' => 'required|unique:customers|max:11',
                    'id' => 'required|integer',
                ]);
        }
    }

    private function validationCheck($validation)
    {
        if ($validation->fails()) {
            return response()->json([
                "type" => "Error",
                "message" => "Validation failed",
                "errors" => $validation->errors(),
            ], 422);
        }
    }
}
?>
