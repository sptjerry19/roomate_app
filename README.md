# Project Tìm Phòng Trọ

Dự án **Tìm Phòng Trọ** là một ứng dụng web giúp người dùng tìm kiếm và đăng tin phòng trọ một cách dễ dàng. Ứng dụng được xây dựng bằng Laravel (backend) và Vue.js (frontend), sử dụng Laravel Mix để quản lý và biên dịch các tài nguyên frontend.

## Công nghệ sử dụng

-   **Backend**: Laravel (PHP framework)
-   **Frontend**: Vue.js (JavaScript framework)
-   **CSS Framework**: Tailwind CSS hoặc Bootstrap (tùy chọn)
-   **Build Tool**: Laravel Mix (Webpack wrapper)
-   **Database**: MySQL
-   **Authentication**: Laravel Sanctum hoặc Passport (tùy chọn)
-   **API**: RESTful API hoặc GraphQL (tùy chọn)

## Tính năng chính

1. **Đăng ký/Đăng nhập**:

    - Người dùng có thể đăng ký tài khoản mới hoặc đăng nhập bằng tài khoản hiện có.
    - Xác thực bằng email hoặc OAuth (Google, Facebook).

2. **Tìm kiếm phòng trọ**:

    - Tìm kiếm phòng trọ theo địa điểm, giá cả, diện tích, và các tiện ích.
    - Hiển thị kết quả tìm kiếm trên bản đồ (sử dụng Google Maps API).

3. **Đăng tin phòng trọ**:

    - Người dùng có thể đăng tin phòng trọ với các thông tin chi tiết như giá thuê, địa chỉ, hình ảnh, và mô tả.
    - Quản lý các tin đã đăng.

4. **Nhắn tin thời gian thực**:

    - Lựa chọn người đăng bài để nhắn tin.
    - Xử lý tin nhắn với thời gian thực

5. **Quản lý tài khoản**:

    - Cập nhật thông tin cá nhân.
    - Đổi mật khẩu.

6. **Quản lý admin**:
    - Quản lý người dùng, tin đăng, và danh mục.
    - Duyệt hoặc xóa tin đăng không phù hợp.

## Cài đặt và chạy dự án

### Yêu cầu hệ thống

-   PHP >= 8.0
-   Composer
-   Node.js >= 16.x
-   npm hoặc yarn
-   MySQL

### Chạy với docker:

1. **Clone dự án**:

    ```bash
    git clone https://github.com/your-username/your-repo-name.git
    cd your-repo-name

    ```

2. **Cài đặt các docker**:

    ```bash
    docker compose up -d

    ```

3. **Truy cập ứng dụng**:
   Mở trình duyệt và truy cập http://localhost:8080.

4. **Truy cập database**:
   Mở trình duyệt và truy cập http://localhost:8081.

### Các bước cài đặt

1. **Clone dự án**:

    ```bash
    git clone https://github.com/your-username/your-repo-name.git
    cd your-repo-name

    ```

2. **Cài đặt các dependency PHP**:

    ```bash
    composer install

    ```

3. **Cài đặt các dependency JavaScript**:

    ```bash
    npm install

    ```

4. **Tạo file .env**:

    ```bash
    cp .env.example .env

    ```

5. **Tạo key cho ứng dụng**:

    ```bash
    php artisan key:generate

    ```

6. **Chạy migration và seed dữ liệu**:

    ```bash
    php artisan migrate --seed

    ```

7. **Biên dịch tài nguyên frontend**:

    ```bash
    npm run dev

    ```

8. **Khởi chạy server**:

    ```bash
    php artisan serve

    ```

9. **Khởi chạy websocket**:

    ```bash
    php artisan websockets:serve

    ```

10. **Khởi chạy storage link**:

    ```bash
    php artisan storage:link

    ```

11. **Truy cập ứng dụng**:
    Mở trình duyệt và truy cập http://localhost:8000.

### Cấu trúc thư mục

-   app/: Chứa các logic backend (Models, Controllers, v.v.).
-   resources/: Chứa các tài nguyên frontend (Vue components, SCSS, v.v.).
-   public/: Chứa các tài nguyên được biên dịch (CSS, JS, images).
-   routes/: Định nghĩa các route của ứng dụng.
-   database/: Chứa migrations và seeders.
-   tests/: Chứa các test case.
