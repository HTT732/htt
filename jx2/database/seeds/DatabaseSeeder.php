<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	
        $this->call(UserSeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(LikeView::class);
        $this->call(SanPhamSeeder::class);
        $this->call(BaiVietSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(LoaiTinSeeder::class);
        $this->call(MessageSeeder::class);
    }
}

class UserSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 50;
		DB::table('users')->insert([
			'username' => 'supperadmin',
			'nickname' => 'Ông Trùm',
			'password' => Hash::make('abc123'),
			'sdt' => '0924008990',
			'fb' => 'https://facebook.com/trunghoang732kt',
			'exp' => 100,
			'level' => 3
		]);
		for ($i = 0; $i <= $limit; $i++) {
			DB::table('users')->insert([
				'username' => str_random(10),
				'nickname' => $faker->name,
				'password' => Hash::make(1),
				'sdt' => $faker->phoneNumber,
				'fb' => $faker->url,
				'exp' => rand(1, 99),
				'level' => 1
			]);
		}
	}
}

class SlideSeeder extends Seeder
{
	public function run()
	{
		DB::table('slides')->insert([
			['url' => 'https://via.placeholder.com/700x300'],
			['url' => 'https://via.placeholder.com/700x300'],
			['url' => 'https://via.placeholder.com/700x300']
		]);
	}
}

class SanPhamSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 50;

		for ($i = 0; $i <= $limit; $i++){
			DB::table('san_phams')->insert([
				'tieude' => $faker->name,
				'server' => $faker->name,
				'noidung' => $faker->paragraph,
				'idUser' => rand(1, 48),
				'idLikeView' => rand(1, 51)
			]);
		}
	}
}

class LoaiTinSeeder extends Seeder
{
	public function run()
	{
		DB::table('loai_tins')->insert([
			['type' => 'Thông báo'],
			['type' => 'Góp ý']
		]);
	}
}

class MessageSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 50;

		for ($i = 0; $i <= $limit; $i++){
			DB::table('messages')->insert([
				'tieude' => $faker->sentence($nbWords = 6, $variableNbWords = true),
				'noidung' => $faker->paragraph,
				'thoigian' => $faker->dateTime($max = 'now', $timezone = null),
				'nguoigui' => $faker->name,
				'nguoinhan' => 'Admin',
				'idLoaiTin' => rand(1, 2)
			]);
		}
	}
}

class BaiVietSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 50;

		for ($i = 0; $i <= $limit; $i++){
			DB::table('bai_viets')->insert([
				'tieude' => $faker->sentence($nbWords = 6, $variableNbWords = true),
				'noidung' => $faker->paragraph,
				'idUser' => rand(3, 35),
				'idLikeView' => rand(52, 100)
			]);
		}

	}
}

class CommentSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 50;

		for ($i = 0; $i <= $limit; $i++){
			DB::table('comments')->insert([
				'noidung' => $faker->paragraph,
				'thoigian' =>$faker->dateTime,
				'idUser' => rand(1, 51),
				'idBaiViet' => rand(1, 51)
			]);
		}
	}
}

class LikeView extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create('vi_VN');
		$limit = 100;

		for ($i = 0; $i <= $limit; $i++){
			DB::table('like_views')->insert([
				'likes' => rand(10, 200),
				'views' => rand(100, 500),
			]);
		}
	}
}