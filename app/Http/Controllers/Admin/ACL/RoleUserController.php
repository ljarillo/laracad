<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $role, $user;
    public function __construct(Role $role, User $user)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    /**
     * user to roles
     *
     * @param  int  $idUser
     * @return \Illuminate\Http\Response
     */
    public function roles($idUser)
    {
        if(!$user = $this->user->find($idUser)){
            return redirect()->back();
        }

        $roles = $user->roles()->paginate();

        return view('admin.pages.users.roles.roles', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * user to roles
     *
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function users($idRole)
    {
        if(!$role = $this->role->find($idRole)){
            return redirect()->back();
        }

        $users = $role->users()->paginate();

        return view('admin.pages.roles.users.users', [
            'role' => $role,
            'users' => $users
        ]);
    }

    /**
     * roles available to user
     *
     * @param  int  $idUser
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function rolesAvailable(Request $request, $idUser)
    {
        if(!$user= $this->user->find($idUser)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $roles = $user->rolesAvailable($request->filter);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $roles,
            'filters' => $filters
        ]);
    }

    /**
     * attach roles to user
     *
     * @param  int  $idUser
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachRolesUser(Request $request, $idUser)
    {
        if(!$user = $this->user->find($idUser)){
            return redirect()->back();
        }

        if(!$request->roles || count($request->roles) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma permissão');
        }

        $user->roles()->attach($request->roles);

        return redirect()
            ->route('users.roles', $user->id)
            ->with('message', 'Atribuida as permissões');
    }

    /**
     * detach roles to user
     *
     * @param  int  $idUser
     * @param  int  $idRole
     * @return \Illuminate\Http\Response
     */
    public function detachRolesUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);
        if(!$user || !$role){
            return redirect()->back();
        }

        $user->roles()->detach($role);

        return redirect()
            ->route('users.roles', $user->id)
            ->with('message', "Desvinculada a permissão {$role->name} do perfil");
    }
}
