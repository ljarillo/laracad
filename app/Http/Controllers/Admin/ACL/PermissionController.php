<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository;
    public function __construct(Permission $permission)
    {
        $this->repository = $permission;

        $this->middleware(['can:permissions']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->repository->latest()->paginate();

        return view('admin.pages.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermission  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());
        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão inserida com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermission  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermission $request, $id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        $permission->update($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$permission = $this->repository->find($id)){
            return redirect()->back();
        }

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão deletada com sucesso');
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
        $permissions = $this->repository->search($request->filter);

        return view('admin.permissions.profiles.index', [
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }
}
