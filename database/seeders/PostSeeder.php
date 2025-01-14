<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Phòng trọ giá rẻ Quận 1',
                'location' => '123 Đường ABC, Quận 1, TP. Hồ Chí Minh',
                'district' => 'Quận 1',
                'ward' => 'Phường 5',
                'price' => '3.000.000',
                'area' => '20m²',
                'status' => 'available',
                'posted_by' => 'Nguyễn Văn A',
                'description' => 'Phòng trọ giá rẻ, đầy đủ tiện nghi, gần trung tâm, thích hợp cho sinh viên và người đi làm.',
                'images' => [
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'room',
            ],
            [
                'id' => 2,
                'title' => 'Tìm roommate ở ghép Quận 3',
                'location' => '45 Đường XYZ, Quận 3, TP. Hồ Chí Minh',
                'district' => 'Quận 3',
                'ward' => 'Phường 10',
                'price' => '1.500.000',
                'area' => '15m²',
                'status' => 'available',
                'posted_by' => 'Trần Thị B',
                'description' => 'Cần tìm bạn nữ ở ghép, phòng rộng rãi thoáng mát, gần chợ và các trường đại học.',
                'images' => [
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'roommate',
            ],
            [
                'id' => 3,
                'title' => 'Phòng trọ mới xây Bình Thạnh',
                'location' => '78 Đường DEF, Bình Thạnh, TP. Hồ Chí Minh',
                'district' => 'Bình Thạnh',
                'ward' => 'Phường 12',
                'price' => '2.800.000',
                'area' => '25m²',
                'status' => 'available',
                'posted_by' => 'Phạm Văn C',
                'description' => 'Phòng trọ mới xây, có gác lửng, an ninh tốt, gần các trường đại học và siêu thị.',
                'images' => [
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'room',
            ],
            [
                'id' => 4,
                'title' => 'Cần tìm bạn ở ghép Thủ Đức',
                'location' => '22 Đường LMN, Thủ Đức, TP. Hồ Chí Minh',
                'district' => 'Thủ Đức',
                'ward' => 'Phường Linh Đông',
                'price' => '1.800.000',
                'area' => '18m²',
                'status' => 'available',
                'posted_by' => 'Lê Thị D',
                'description' => 'Cần tìm bạn ở ghép, phòng rộng rãi, có sẵn đồ dùng, điện nước giá nhà nước.',
                'images' => [
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'roommate',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
