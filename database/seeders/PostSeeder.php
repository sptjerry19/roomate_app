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

        $districts = ["Quận Ba Đình", "Quận Cầu Giấy", "Quận Hoàn Kiếm", "Quận Hai Bà Trưng", "Quận Tây Hồ"];
        $wards = ["Phường 1", "Phường 5", "Phường 10", "Phường 12", "Phường Linh Đông"];
        $names = ["Nguyễn Văn A", "Trần Thị B", "Phạm Văn C", "Lê Thị D", "Hoàng Minh E"];
        $descriptions = [
            "Phòng trọ giá rẻ, đầy đủ tiện nghi, gần trung tâm, thích hợp cho sinh viên và người đi làm.",
            "Cần tìm bạn ở ghép, phòng rộng rãi thoáng mát, gần chợ và các trường đại học.",
            "Phòng trọ mới xây, có gác lửng, an ninh tốt, gần các trường đại học và siêu thị.",
            "Phòng đầy đủ đồ, điện nước giá nhà nước, có sẵn điều hòa, nóng lạnh.",
            "Phòng gần trung tâm, thuận tiện đi lại, có chỗ để xe, wifi miễn phí."
        ];
        $imageUrls = [
            "https://ecogreen-saigon.vn/uploads/phong-tro-la-loai-hinh-nha-o-pho-bien-gia-re-tien-loi-cho-sinh-vien-va-nguoi-di-lam.png",
            "https://tromoi.com/uploads/members/hiephoang/thang%208/06_08/tim-phong-tro-gia-re-va-meo-nho-huu-ich-1%20(2).jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyk7GbGKbep7Z67R8vJbkXiojw1hjcegj8RQ&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp05_R4OYBwgyt7K-QCvqBWHmAZBn3pyJrIQ&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShkW5ytlFH3JvpGoS11yg9YlNlZSuFP8l9uQ&s",
            "https://sbshouse.vn/wp-content/uploads/2019/11/M%E1%BA%ABu-thi%E1%BA%BFt-k%E1%BA%BF-ph%C3%B2ng-tr%E1%BB%8D-%C4%91%E1%BA%B9p.jpg",
            "https://ecogreen-saigon.vn/uploads/phong-tro-la-loai-hinh-nha-o-pho-bien-gia-re-tien-loi-cho-sinh-vien-va-nguoi-di-lam.png",
            "https://media.vneconomy.vn/images/upload/2024/08/12/gia-thue-phong-tro-tp-ho-chi-minh.jpg",
            "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
        ];
        $types = ["room", "roommate"];

        $posts = [];

        for ($i = 0; $i < 100; $i++) {
            $district = $districts[array_rand($districts)];
            $ward = $wards[array_rand($wards)];
            $name = $names[array_rand($names)];
            $description = $descriptions[array_rand($descriptions)];
            $images = array_rand(array_flip($imageUrls), rand(2, 5));

            $posts[] = [
                'title' => "Phòng trọ tại $ward, $district",
                'location' => rand(1, 999) . " Đường ABC, $district, TP. Hà Nội",
                'district' => $district,
                'ward' => $ward,
                'price' => rand(1000000, 5000000),
                'area' => rand(15, 30),
                'status' => 'available',
                'posted_by' => $name,
                'description' => $description,
                'images' => is_array($images) ? $images : [$images],
                'type' => $types[array_rand($types)],
            ];
        }

        // Lưu dữ liệu vào database
        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
