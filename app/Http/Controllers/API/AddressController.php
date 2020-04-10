<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Http\Resources\API\UserAddressResource;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\CreateAddressRequest;




class AddressController extends Controller
{

    public function index()
    {

        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address = Address::where('user_id', $user->profile->id)->get();

            return UserAddressResource::collection(
                Address::where('user_id', $user->profile->id)->get()
            );
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function show(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
            return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        dd($request->address);
        $user = auth()->user();
        if ($user->hasRole('client')) {
            $address->update($request->all());
            dd($address);
            return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }
    public function store(CreateAddressRequest $request, Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
        $address->create($request->all());
        return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }

    public function delete(Address $address)
    {
        $user = auth()->user();
        if ($user->hasRole('client')) {
        $address->delete($address);
        return response()->json([
            'message' => 'address Deleted'
        ], 204);
        return new UserAddressResource($address);
        } else {
            return response()->json(['error'=>'404 Not Found'], 404);
        }
    }
    
}
