<?php

namespace BaseLaravel\Http\Controllers;

use BaseLaravel\Http\Requests\ExampleRequest;
use BaseLaravel\Repositories\UserRepository;

class ExampleController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate();
        return view('example.index',compact('users'));
    }

    public function create()
    {
        $users = $this->userRepository->lists();
        return view('example.create', compact('users'));
    }

    public function store(ExampleRequest $request)
    {
        $data = $request->all();
        $this->userRepository->create($data);
        return redirect()->route('example.index');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('example.edit', compact('user'));
    }

    public function update(ExampleRequest $request, $id)
    {
        $data = $request->all();
        $this->userRepository->update($data,$id);
        return redirect()->route('example.index');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('example.index');
    }

}
