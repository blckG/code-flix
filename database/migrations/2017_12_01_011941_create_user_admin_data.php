<?php


use Illuminate\Database\Migrations\Migration;

class CreateUserAdminData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeFlix\Models\User::create([
            'name' => env('ADMIN_DEFAULT_NAME', 'Aministrator'),
            'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'),
            'role' => \CodeFlix\Models\User::ROLE_ADMIN,
            'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD', '123456')),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = \CodeFlix\Models\User::where('email', env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'))->first();
        if($user instanceof \CodeFlix\Models\User){
            $user->delete();
        }
    }
}
