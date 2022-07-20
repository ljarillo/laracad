<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $permission, $role;
    public function __construct(Permission $permission, Role $role)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    /**
     * role to permissions
     *
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function permissions($idRole)
    {
        if(!$role = $this->role->find($idRole)){
            return redirect()->back();
        }

        $permissions = $role->permissions()->paginate();

        return view('admin.pages.roles.permissions.permissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * role to permissions
     *
     * @param  int  $idPermission
     * @return \Illuminate\Http\Response
     */
    public function roles($idPermission)
    {
        if(!$permission = $this->permission->find($idPermission)){
            return redirect()->back();
        }

        $roles = $permission->roles()->paginate();

        return view('admin.pages.permissions.roles.roles', [
            'permission' => $permission,
            'roles' => $roles
        ]);
    }

    /**
     * permissions available to role
     *
     * @param  int  $idRole
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function permissionsAvailable(Request $request, $idRole)
    {
        if(!$role= $this->role->find($idRole)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    /**
     * attach permissions to role
     *
     * @param  int  $idRole
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachPermissionsRole(Request $request, $idRole)
    {
        if(!$role = $this->role->find($idRole)){
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma permissão');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()
            ->route('roles.permissions', $role->id)
            ->with('message', 'Atribuida as permissões');
    }

    /**
     * detach permissions to role
     *
     * @param  int  $idRole
     * @param  int  $idPermission
     * @return \Illuminate\Http\Response
     */
    public function detachPermissionsRole($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);
        if(!$role || !$permission){
            return redirect()->back();
        }

        $role->permissions()->detach($permission);

        return redirect()
            ->route('roles.permissions', $role->id)
            ->with('message', "Desvinculada a permissão {$permission->name} do perfil");
    }
}
