<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepositoryInterface;
use App\Services\CountryService;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return response()->json($users);
    }


    public function create()
    {
        //
    }


    public function store(UserCreateRequest $request)
    {

        $user = $this->userRepository->create($request->all());
        return Response()->json(['message' => "User created Successfully", 'data' => $user]);
    }


    public function show(string $id)
    {
        $user = $this->userRepository->find($id);
        return  response()->json($user);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userRepository->update($id, $request->all());
        return Response()->json(['message' => "User Updated Successfully", 'data' => $user]);

    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->userRepository->delete($id);
        return Response()->json(['message' => "User Deleted Successfully", 'data' => []]);

    }

    public function getCountries(CountryService $countryService)
    {
        $countries = $countryService->getCountries();

        return response()->json($countries);
    }

}
