<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Nhanvien;
use App\CRUD\_Sinhvien;
use App\CRUD\_Nhanvien;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:Super-Admin|read permissions-roles',
        ['only'=>['role','permissions','supply_role_and_permissions']]);
        $this->middleware('role_or_permission:Super-Admin|create permissions-roles',['only'=>['createRole','createPermissions']]);
        $this->middleware('role_or_permission:Super-Admin|edit permissions-roles',
        ['only'=>['formUpdateRole','updateRole','roleUpdatePermissions','roleUpdatePermissionsPost',
        'formUpdatePermissions','updatePermissions','supply_role','supply_role_post','supply_permissions','supply_permissions_post']]);
        $this->middleware('role_or_permission:Super-Admin|delete permissions-roles',['only'=>['deleteRole','deletePermissions']]);
    }
    //role
    public function role(Request $request) {
        // dd();
        // thu super admin
        // $request->user()->assignRole(['Super-Admin']);
        // $permissions = Role::create(['name' => 'user']);
        $role = Role::whereNotIn('name', ['Super-Admin'])->get();
        return view('backend.permission.role', compact('role'));
    }

    public function createRole(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required',
        ],[
            'role.required' => "Vui lòng nhập vai trò"
        ]);

        try {
            $role = Role::create(['name' => $request['role']]);
        return redirect()->route('permission.role')->with('success', 'Thêm vai trò thành công');
        } catch (\Throwable $th) {
            return redirect()->route('permission.role')->with('error', 'Thêm vai trò thất bại');
        }
    }

    public function deleteRole($id = null)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        // dd($role);
        return redirect()->route('permission.role')->with('success', 'Xoá vai trò thành công');
    }

    public function formUpdateRole($id = null)
    {
        $name = Role::where('id', $id)->first()['name'];
        return redirect()->route('permission.role')->with('update', $id)->with('name', $name);
    }

    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required',
        ],[
            'role.required' => "Vui lòng nhập vai trò"
        ]);

        Role::where('id', $request['id'])->update(['name' => $request['role_update']]);
        return redirect()->route('permission.role')->with('success', 'Sửa tên vai trò thành công');
    }

    public function roleUpdatePermissions($name)
    {
        $book = Permission::where('name', 'like', '%books%')->get();
        $user = Permission::where('name', 'like', '%users%')->get();
        $lr = Permission::where('name', 'like', '%lend-return%')->get();
        $pr = Permission::where('name', 'like', '%permissions-roles%')->get();
        $statistic = Permission::where('name', 'like', '%statistic%')->get();
        // $other = Permission::whereNot('name', 'like', '%statistic%')
        // ->whereNot('name', 'like', '%books%')
        // ->whereNot('name', 'like', '%users%')
        // ->whereNot('name', 'like', '%lend-return%')
        // ->whereNot('name', 'like', '%permissions-roles%')
        // ->get();
        // dd($other);
        $role = Role::findByName($name);
        $per = $role->permissions->pluck('name');
        return view('backend.permission.role-up-per', compact('role', 'book', 'user', 'lr', 'pr', 'statistic', 'per', 'name'));
    }

    public function roleUpdatePermissionsPost(Request $request)
    {
        // dd($request->all());
        $name = $request['name'];
        $role = Role::findByName($name);
        $per = $role->syncPermissions($request['per']);
        return redirect()->route('permission.role')->with('success', 'Thêm quyền cho vai trò thành công');
    }

    // permissions
    public function permissions(Request $request) {
        // dd();
        // thu super admin
        // $request->user()->assignRole(['Super-Admin']);
        // $role = Role::create(['name' => 'user']);
        $permissions = Permission::get();
        return view('backend.permission.permissions', compact('permissions'));
    }


    public function createPermissions(Request $request)
    {
        $validated = $request->validate([
            'permissions' => 'required',
        ],[
            'permissions.required' => "Vui lòng nhập tên quyền"
        ]);
        // dd($request['role']);
        try {
            $permissions = Permission::create(['name' => $request['permissions']]);
            return redirect()->route('permission.permissions')->with('success', 'Thêm quyền thành công');
        } catch (\Throwable $th) {
            return redirect()->route('permission.permissions')->with('error', 'Thêm quyền thất bại');
        }
    }

    public function deletePermissions($id = null)
    {
        // dd($id = null);
        $permissions = Permission::findOrFail($id = null); $permissions->delete();
        return redirect()->route('permission.permissions')->with('success', 'Xoá quyền thành công');
    }

    public function formUpdatePermissions($id = null)
    {
        $name = Permission::where('id', $id)->first()['name'];
        return redirect()->route('permission.permissions')->with('update', $id)->with('name', $name);
    }

    public function updatePermissions(Request $request)
    {
        $validated = $request->validate([
            'permissions_update' => 'required',
        ],[
            'permissions_update.required' => "Vui lòng nhập tên quyền"
        ]);

        Permission::where('id', $request['id'])->update(['name' => $request['permissions_update']]);
        return redirect()->route('permission.permissions')->with('success', 'Sửa tên quyền thành công');
    }

    // supply role
    public function supply_role_and_permissions(Request $request)
    {
        $nv = new _Nhanvien();
        $sv = new _Sinhvien();
        $user = new User();

        if (isset($request->query()['ms'])) {
            // $data = User::where('id','like', '%'.$request->query()['ms'].'%')->get();
            $datasv = $sv->getSearch('mssv', $request->query('ms'));
            $datanv = $nv->getSearch('mssv', $request->query('ms'));
            // dd($data);
            $datasv->withPath(url()->full());
            $datanv->withPath(url()->full());
            $title = 'Danh sách sinh viên tìm kiếm theo mã số: '.$request->query('mssv');
            return view('backend.permission.supply', ['form' => true, 'datasv' => $datasv, 'datanv' => $datanv, 'user' => $user]);
        } else {
            $datasv = $sv->getNew();
            return view('backend.permission.supply', ['form' => false, 'datasv' => $datasv, 'user' => $user]);
        }

    }

    public function supply_role(Request $request, $id = null)
    {
        if ($id != null) {
            $role = Role::whereNotIn('name', ['Super-Admin'])->get();
            $roleOfuser = User::find($id)->roles->pluck('name') == '[]' ? '' : User::find($id)->roles->pluck('name')[0];
            $type = $request->query('type');
            if ($type == 'sv') {
                $sv = new _Sinhvien();
                $data = $sv->getById($id);
            }else {
                $data = Nhanvien::where('mssv',$id)->first();
            }

            return view('backend.permission.role-supply', ['data' => $data, 'role' => $role, 'roleOfuser' => $roleOfuser,'type' => $type]);
        }
    }

    public function supply_role_post(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required',
        ],[
            'role.required' => "Vui lòng chọn vai trò"
        ]);

        // dd($request->all());
        $user = User::find($request['id'])->syncRoles($request['role']);
        return redirect()->route('permission.supply_role', ['id'=>$request['id'], "type" => $request['type']])->with('success', 'Cấp vai trò thành công');
    }

    public function supply_permissions(Request $request, $id = null)
    {
        if ($id != null) {
            $book = Permission::where('name', 'like', '%books%')->get();
            $user = Permission::where('name', 'like', '%users%')->get();
            $lr = Permission::where('name', 'like', '%lend-return%')->get();
            $pr = Permission::where('name', 'like', '%permissions-roles%')->get();
            $statistic = Permission::where('name', 'like', '%statistic%')->get();
            // $permissions = Permission::get();
            $permissionsOfuser = User::find($id)->getPermissionsViaRoles();
            $getDirectPermissions = User::find($id)->getDirectPermissions();
            $type = $request->query('type');
            $arr = ['read permissions-roles','create permissions-roles','edit permissions-roles','delete permissions-roles'];

            if ($type == 'sv') {
                $sv = new _Sinhvien();
                $data = $sv->getById($id);
            }else {
                $data = Nhanvien::where('mssv',$id)->first();
            }

            return view('backend.permission.permissions-supply',
            compact('data', 'book', 'user', 'lr', 'pr', 'statistic', 'getDirectPermissions', 'permissionsOfuser','type', 'arr'));
        }
    }


    public function supply_permissions_post(Request $request)
    {
        // dd($request->all());
        $user = User::find($request['id']);

        if (isset($request['permissions'])) {
            // bỏ ra các quyền đã cấp trước đó, k thể thêm hoặc xoá
            $user->syncPermissions($request['permissions']);
        }else {
            $user->syncPermissions([]);
        }

        return redirect()->route('permission.supply_permissions', ['id'=>$request['id'], "type" => $request['type']])
        ->with('success', 'Cấp quyền thành công');
    }
}
