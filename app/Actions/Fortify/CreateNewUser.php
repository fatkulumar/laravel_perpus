<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'nis' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        if(User::count() == 0)
        {
            //upload
            $file = $input['nama_logo'];
            $nama_file= $file->getClientOriginalName();
            $extension = $input['nama_logo']->extension();
            $imgname_logo = $nama_file .' '. Carbon::now()->format('d-m-yy H-i-s').'.'.$extension;
            $tujuan_upload = Storage::putFileAs('public/fotoku', $file, $imgname_logo);
            
            $admins = new Admin;
            $admins->nama_logo = $imgname_logo;
            $admins->nama_instansi = $input['nama_instansi'];
            $admins->save();
        }

        return User::create([
            'role' => $input['role'],
            'nis' => $input['nis'],
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
