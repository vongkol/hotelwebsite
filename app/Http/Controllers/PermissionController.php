<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class PermissionController extends Controller
{
    // index
    public function index($id)
    {
        $this->data['role'] = DB::table('roles')->where('id', $id)->first();
        $this->data['permissions'] = DB::table('permissions')->orderBy('permissions.id', 'ASC')->get();
        $this->data['roles'] = DB::table('roles')->get();
        $this->data['role_id'] = $id;

        if($id != '') {
            $this->data['per_role'] = DB::select('select tb.id, `tb`.insert,
       `tb`.update,
             `tb`.delete,
       `tb`.list,
       `permissions`.`name`,
             `permissions`.`id` as permission_id
            from  `permissions`
            left join (select * from `role_permissions` where `role_permissions`.`role_id` = ' . $id . ') tb on `permissions`.id = tb.permission_id
            order by `permissions`.`id` asc');

        }
        return view('permissions.index', $this->data);
    }
    // save or update
    public function save(Request $r)
    {
        $i=0;
        if($r->id>0)
        {
            // update
            $data = array(
                'role_id' => $r->role_id,
                'permission_id' => $r->permission_id,
                'list' => $r->list,
                'insert' => $r->insert,
                'update' => $r->update,
                'delete' => $r->delete
            );
            DB::table('role_permissions')->where('id', $r->id)->update($data);
            $i = $r->id;
        }
        else
        {
            // insert new

            $data = array(
                'role_id' => $r->role_id,
                'permission_id' => $r->permission_id,
                'list' => $r->list,
                'insert' => $r->insert,
                'update' => $r->update,
                'delete' => $r->delete
            );
            $i = DB::table('role_permissions')->insertGetId($data);
        }
        return $i;
    }
}
