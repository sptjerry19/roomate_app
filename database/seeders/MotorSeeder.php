<?php

namespace Database\Seeders;

use App\Models\Motor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 300 bản ghi Motor
        for ($i = 1; $i <= 300; $i++) {
            // Mỗi bản ghi có một mảng measurements riêng, với số lượng mẫu ngẫu nhiên từ 5 đến 20
            $measurements = [];
            $randomNumber = rand(5, 20);
            for ($j = 1; $j <= $randomNumber; $j++) {
                $measurements[] = [
                    'time'     => $j,
                    // Sinh giá trị speed ngẫu nhiên từ 1.0 đến 10.0
                    'speed'    => rand(10, 100) / 10,
                    'distance' => 20,
                ];
            }

            // Tạo tên motor: random string + ngày giờ hiện tại (định dạng YmdHis)
            $name = Str::random(8) . '_' . now()->format('YmdHis');

            // Tạo bản ghi Motor với trường 'name' và 'data' chứa mảng measurements
            Motor::create([
                'name' => $name,
                'data' => $measurements,
            ]);
        }

        $this->command->info('Seeder MotorSeeder đã chạy thành công!');
    }
}
