<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;
    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware(['can:roles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->latest()->paginate();

        return view('admin.pages.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());
        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$role = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$role = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRole $request, $id)
    {
        if(!$role = $this->repository->find($id)){
            return redirect()->back();
        }

        $role->update($request->all());

        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$role = $this->repository->find($id)){
            return redirect()->back();
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('message', 'Perfil deletado com sucesso');
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
        $roles = $this->repository->search($request->filter);

        return view('admin.pages.roles.index', [
            'roles' => $roles,
            'filters' => $filters
        ]);
    }
}
