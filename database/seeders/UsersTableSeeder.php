<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成数据集合
        User::factory()->count(10)->create();

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = '子曰';
        $user->email = 'zxf@163.com';
        $user->avatar = 'http://larabbs.test/uploads/images/avatars/202303/31/1_1680251784_KizOeGMDdC.jpg';
        $user->save();
    }
}
