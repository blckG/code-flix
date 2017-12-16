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
        $model = \CodeFlix\Models\User::create([
            'name' => env('ADMIN_DEFAULT_NAME', 'Aministrator'),
            'email' => env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'),
            'role' => \CodeFlix\Models\User::ROLE_ADMIN,
            'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD', '123456')),
        ]);
        $model->verified = true;
        $model->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table = (new \CodeFlix\Models\User())->getTable();
        \DB::table($table)
            ->where('email', '=', env('ADMIN_DEFAULT_EMAIL', 'admin@user.com'))
            ->delete();
    }
}
