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
                'title' => 'Phòng trọ giá rẻ Quận Ba Đình',
                'location' => '123 Đường ABC, Quận Ba Đình, TP. Hà Nội',
                'district' => 'Quận Ba Đình',
                'ward' => 'Phường 5',
                'price' => '3.000.000',
                'area' => '20',
                'status' => 'available',
                'posted_by' => 'Nguyễn Văn A',
                'description' => 'Phòng trọ giá rẻ, đầy đủ tiện nghi, gần trung tâm, thích hợp cho sinh viên và người đi làm.',
                'images' => [
                    'https://ecogreen-saigon.vn/uploads/phong-tro-la-loai-hinh-nha-o-pho-bien-gia-re-tien-loi-cho-sinh-vien-va-nguoi-di-lam.png',
                    'https://media.vneconomy.vn/images/upload/2024/08/12/gia-thue-phong-tro-tp-ho-chi-minh.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'room',
            ],
            [
                'title' => 'Tìm roommate ở ghép Quận Cầu Giấy',
                'location' => '45 Đường XYZ, Quận Cầu Giấy, TP. Hà Nội',
                'district' => 'Quận Cầu Giấy',
                'ward' => 'Phường 10',
                'price' => '1.500.000',
                'area' => '15',
                'status' => 'available',
                'posted_by' => 'Trần Thị B',
                'description' => 'Cần tìm bạn nữ ở ghép, phòng rộng rãi thoáng mát, gần chợ và các trường đại học.',
                'images' => [
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShkW5ytlFH3JvpGoS11yg9YlNlZSuFP8l9uQ&s',
                    'https://sbshouse.vn/wp-content/uploads/2019/11/M%E1%BA%ABu-thi%E1%BA%BFt-k%E1%BA%BF-ph%C3%B2ng-tr%E1%BB%8D-%C4%91%E1%BA%B9p.jpg',
                ],
                'type' => 'roommate',
            ],
            [
                'title' => 'Phòng trọ mới xây Quận Cầu Giấy',
                'location' => '78 Đường DEF, Quận Cầu Giấy, TP. Hà Nội',
                'district' => 'Quận Cầu Giấy',
                'ward' => 'Phường 12',
                'price' => '2.800.000',
                'area' => '25',
                'status' => 'available',
                'posted_by' => 'Phạm Văn C',
                'description' => 'Phòng trọ mới xây, có gác lửng, an ninh tốt, gần các trường đại học và siêu thị.',
                'images' => [
                    'https://tromoi.com/uploads/members/hiephoang/thang%208/06_08/tim-phong-tro-gia-re-va-meo-nho-huu-ich-1%20(2).jpg',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyk7GbGKbep7Z67R8vJbkXiojw1hjcegj8RQ&s',
                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp05_R4OYBwgyt7K-QCvqBWHmAZBn3pyJrIQ&s',
                    'https://s-housing.vn/wp-content/uploads/2022/09/thiet-ke-phong-tro-dep-7.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                    'https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg',
                ],
                'type' => 'room',
            ],
            [
                'title' => 'Cần tìm bạn ở ghép Quận Hoàn Kiếm',
                'location' => '22 Đường LMN, Quận Hoàn Kiếm, TP. Hà Nội',
                'district' => 'Quận Hoàn Kiếm',
                'ward' => 'Phường Linh Đông',
                'price' => '1.800.000',
                'area' => '18',
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
