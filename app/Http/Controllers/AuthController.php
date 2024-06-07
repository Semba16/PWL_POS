<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        //kita ambil data user lalu simpen pada variabel $user
        $user = Auth::user();

        //kondisi jika usernya ada
        if ($user) {
            // jika usernya memiliki level admin
            if ( $user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // jika usernya memiliki level manager
            else if ($user->level = '2') {
                return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // kita buat validasi pada saat tombol login diklik
        // validasinya username & password wajib di isi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // ambil data request username & password saja
        $scredential = $request->only('username', 'password');
        //cek jika data username dan password valid (sesuai) dengan data
        if (auth::attempt($scredential)) {
            // kalau berhasil simpan data user ya di variabel &user
            $user = Auth::user();

        // cek lagi jika level user admin maka arahkan ke halaman admin
        if ($user->level_id == '1') {
            //dd($user->level_id);
            return redirect()->intended('admin');
        }
        // tapi jika level user nya user biasa maka arahkan ke halaman user
        else if ($user->level_id == '2') {
            return redirect()->intended('manager');
        }
        // jika belum ada role maka ke halaman
        return redirect()->intended('/');
        }
        //jika ga ada user yang valid maka kembalikan lagi ke halaman login
        // pastikan kirim pesan error juga kalau login gagal
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'pastikan kembali username dan password yang dimasukkan sudah benar']);
    }

    public function register()
    {
        // tampilkan view register
        return view('register');
    }

    // aksi form register
    public function proses_register(Request $request)
    {
        // kita buat validasi nih buat proses registrasi
        // validasinya yaitu semua field wajib di isi
        // validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator = Validator::make($request->all(), [
            'nama' => 'requeired',
            'username' => 'required|unique:m_user',
            'password' => 'reqiured'
        ]);
        // kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // kalau berhasil isi level & hash passwordnya ya biar secure
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // masukkan semua data pada request ke table user
        UserModel::create($request->all());

        // kalau berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // logout itu harus menghapus sessionnya
        $request->session()->flush();

        // jalankan juga fungsi logout pada auth 
        Auth::logout();
        // Kembali kan ke halaman login
        return Redirect('login');
    }
}