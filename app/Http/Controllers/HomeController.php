<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Department;
use App\Models\User;
use App\Models\TotalAccess;
use PDF;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{  
    public $search = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


   
    public function index(Request $request)
    {
        $post = $request->input();

        $roles = Role::get();

        $departments = Department::get();

        $users = User::where(function($w) use ($post){
            if (isset($post['id'])) {
                if(!empty($post['id']))
                {
                    $w->where('id', 'like', '%' . $post['id']. '%');
                }
            }  elseif (isset($post['first_name'])) {
                if(!empty($post['first_name']))
                {
                    $w->where('first_name', 'like', '%' . $post['first_name']. '%');
                }
            }
             elseif(isset($post['department_id'])){
                 if (!empty($post['department_id'])) {
                     $w->where('department_id', $post['department_id']);
                 }
             }
             
        })->get()->map(function($value){
            return [
                'id' => $value->id,
                'first_name' => $value->first_name,
                'last_name' => $value->last_name,
                'employe_id' => $value->employe_id,
                'email' => $value->email,
                'rol_id' => $value->rol_id,
                'department_id' => $value->department_id,
                'password' => $value->password,
                'total' => User::where('id', $value->id)->get()->map(function($value2){
                    return [
                        'total_acces' => $value2->totalAccess->count(),
                        'date' => $value2->totalAccess
                    ];      
                })
            ];
            
        });
        //dd($users);
        return view('home', ['roles' => $roles, 'departments' => $departments, 'users' => $users]);


    }

    public function downloadPDF(Request $request){
        $roles = Role::get();
        $users = User::get()->map(function($value){
            return [
                'id' => $value->id,
                'first_name' => $value->first_name,
                'last_name' => $value->last_name,
                'employe_id' => $value->employe_id,
                'email' => $value->email,
                'rol_id' => $value->rol_id,
                'department_id' => $value->department_id,
                'password' => $value->password,
                'total' => User::where('id', $value->id)->get()->map(function($value2){
                    return [
                        'total_acces' => $value2->totalAccess->count(),
                        'date' => $value2->totalAccess
                    ];      
                })
            ];
            
        });
        $departments = Department::get();
        $post = $request->input();
      
    $totalAccess = TotalAccess::all();
    $pdf = PDF::loadView( 'home',['roles' => $roles, 'departments' => $departments,'totalAccess' => $totalAccess,'users' => $users])->setOptions(['defaultFont' => 'sans-serif']);
 
    return $pdf->download('User.pdf');

 
    }




    public function login(Request $request)
    {
        $roles = Role::get();

        $departments = Department::get();

        $users = User::get();
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'No Tiene Acceso Al Sistema'
            ], 401);
        $user = $request->user();

        TotalAccess::create([
            'total' => Carbon::now(),
            'user_id' => Auth::user()->id
        ]);

        if ($user->rol_id == 1) {
            return view('home', ['roles' => $roles, 'departments' => $departments, 'users' => $users]);
        } elseif($user->rol_id == 2) {
            return view('employee',['users' => $users]);
        }
    }

    public function storeUser(Request $request)
    {
        try {
            User::create([
                'employe_id' => $request->employe_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'rol_id' => $request->roles,
                'department_id' => $request->departments,
                'password' => Hash::make($request->password),
             ]);
        
             return back();
        } catch (\Throwable $th) {
            return response()->json(['algo slaio mal' => $th->getMessage()]);
        }
    }

    public function updateUser($id)
    {
        $user = User::find($id);

        $roles = Role::get();

        $departments = Department::get();

        return view('edit', ['id' => $id, 'roles' => $roles, 'departments' => $departments, 'user' => $user]);
    }
    public function updateUserId(Request $request, $id)
    {
        try {
            $user = User::find($request->id)->update([
                'employe_id' => $request->employe_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'rol_id' => $request->roles,
                'department_id' => $request->departments,
                'password' => $request->password,
             ]);
             $user = User::find($id);

             $roles = Role::get();
     
             $departments = Department::get();

            $users = User::get();

            return redirect()->route('home', ['roles' => $roles, 'departments' => $departments, 'users' => $users]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->delete();
             return back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
