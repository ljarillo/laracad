<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;
    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        $this->middleware(['can:profiles']);
    }

    /**
     * profile to permissions
     *
     * @param  int  $idProfile
     * @return \Illuminate\Http\Response
     */
    public function permissions($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', [
            'profile' => $profile,
            'permissions' => $permissions
        ]);
    }

    /**
     * profile to permissions
     *
     * @param  int  $idPermission
     * @return \Illuminate\Http\Response
     */
    public function profiles($idPermission)
    {
        if(!$permission = $this->permission->find($idPermission)){
            return redirect()->back();
        }

        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', [
            'permission' => $permission,
            'profiles' => $profiles
        ]);
    }

    /**
     * permissions available to profile
     *
     * @param  int  $idProfile
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function permissionsAvailable(Request $request, $idProfile)
    {
        if(!$profile= $this->profile->find($idProfile)){
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions,
            'filters' => $filters
        ]);
    }

    /**
     * attach permissions to profile
     *
     * @param  int  $idProfile
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)){
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0){
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()
            ->route('profiles.permissions', $profile->id)
            ->with('message', 'Atribuida as permissões');
    }

    /**
     * detach permissions to profile
     *
     * @param  int  $idProfile
     * @param  int  $idPermission
     * @return \Illuminate\Http\Response
     */
    public function detachPermissionsProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if(!$profile || !$permission){
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()
            ->route('profiles.permissions', $profile->id)
            ->with('message', "Desvinculada a permissão {$permission->name} do perfil");
    }
}
