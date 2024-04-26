<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function index()
    
    {

        {
            $breadcrumb = (object) [
                'title' => 'Daftar User',
                'list' => ['Home', 'User']
            ];
    
            $page = (object)[
                'title' => 'Daftar user yang terdaftar dalam sistem'
            ];
    
            $activeMenu = 'user';
    
    
            return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
        }
    
        //$user = UserModel::all();
        //$user = UserModel::with('level')->get();
        //return view('user', ['data' => $user]);
    }

                //'username' => 'manager50',
                //'nama' => 'Manager50',
                //'password' => Hash::make('12345'),
                //'level_id' => 2,
        //]);

        //$user->username = 'manager51';
        //$user->save();

        //$user->wasChanged();
        //$user->wasChanged('username');
        //$user->wasChanged(['username', 'level_id']);
        //$user->wasChanged('nama');
        //$user->wasChanged(['nama', 'username']);
        //dd($user->wasChanged(['nama', 'username']));
        
        public function tambah()
        {
            return view('user_tambah');
        } 
        public function tambah_simpan(Request $request)
        {
            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make('$request->password'),
                'level_id' => $request->level_id
            ]);
            return redirect('/user');
        }
        public function ubah($id)
        {
            $user = UserModel::find($id);
            return view('user_ubah', ['data' => $user]);
        }
        public function ubah_simpan($id, Request $request)
        {
            $user = UserModel::find($id);

            $user->username = $request->username;
            $user->nama = $request->nama;
            $user->password = Hash::make('$request->Password');
            $user->level_id = $request->level_id;

            $user->save();

            return redirect('/user');
        }
        public function hapus($id)
        {
            $user = UserModel::find($id);
            $user->delete();

            return redirect('/user');
        } 

         public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil ditambahkan');
    }


    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

      
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }


    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

       

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $btn  = '<a href="' . url('/user/' . $user->user_id) . '"class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }



        
}