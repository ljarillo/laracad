<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;
    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:users']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->tenantUser()->latest()->paginate();

        return view('admin.pages.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);
        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        $data = $request->only(['name', 'email']);

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id)){
            return redirect()->back();
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuário deletado com sucesso');
    }

    /**
     * search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filters' => $filters
        ]);
    }
}
