<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function index()
    
    {
        //$user = UserModel::all();
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
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
}