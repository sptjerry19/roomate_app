<template>
    <div class="mt-28">
        <!-- Header Navbar -->
        <nav
            class="fixed top-0 left-0 z-20 w-full bg-white py-2.5 px-4 shadow-md"
        >
            <div class="container mx-auto flex items-center justify-between">
                <!-- Logo and Dropdown -->
                <div class="flex items-center space-x-3">
                    <router-link to="/">
                        <img
                            src="https://aahome.click/storage/logo.png"
                            alt="Logo"
                            class="h-8 w-8 object-contain"
                        />
                    </router-link>
                    <select
                        class="border border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                        @change="navigateToRoute($event)"
                    >
                        <option value="/advertisement">Quảng cáo</option>
                        <option value="/">Trang chủ</option>
                        <option value="/room">Phòng Trọ</option>
                        <option value="/roommate">Roommate</option>
                    </select>
                </div>

                <!-- Search Bar -->
                <div class="flex-grow mx-6">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Tìm kiếm"
                            v-model="selectedFilters.keyword"
                            @input="
                                selectFilter(selectedFilters.keyword, 'keyword')
                            "
                            class="w-5/6 rounded-full border border-gray-300 py-2 px-4 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        />
                        <!-- <button
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-6-6m3-9a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                    />
                                </svg>
                            </button> -->
                    </div>
                </div>

                <!-- Icons and Post Button -->
                <div
                    v-if="user"
                    class="flex items-center space-x-4 mt-4 md:mt-0 md:order-2"
                >
                    <!-- Avatar -->
                    <div class="relative">
                        <button
                            @click="toggleAvatarDropdown"
                            class="relative focus:outline-none"
                        >
                            <img
                                class="w-10 h-10 rounded-full"
                                :src="
                                    user.avatar
                                        ? user.avatar
                                        : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg'
                                "
                                alt="User Avatar"
                            />
                        </button>

                        <!-- Dropdown menu -->
                        <div
                            v-if="showDropdown"
                            class="absolute -left-12 mt-2 w-48 bg-white rounded-lg shadow-lg z-20"
                        >
                            <router-link
                                to="/profile"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                Xem thông tin
                            </router-link>
                            <router-link
                                to="/manage"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                Thông tin bài đăng
                            </router-link>
                            <button
                                @click="logout"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            >
                                Đăng xuất
                            </button>
                        </div>
                    </div>

                    <!-- Notification Icon -->
                    <div class="relative">
                        <!-- Notification Button -->
                        <button
                            @mouseover="showDropdownNotification = true"
                            @mouseleave="hideDropdown"
                            class="relative"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-6 w-6 text-blue-700"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9.75V8.25a6 6 0 00-12 0v1.5a5.25 5.25 0 0010.5 0zM10.5 21.75a1.5 1.5 0 001.5-1.5H9a1.5 1.5 0 001.5 1.5z"
                                />
                            </svg>
                            <span
                                v-if="unreadCount > 0"
                                class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white"
                            >
                                {{ unreadCount }}
                            </span>
                        </button>

                        <!-- Notification Dropdown -->
                        <div
                            v-if="showDropdownNotification"
                            class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-md border"
                            @mouseover="showDropdownNotification = true"
                            @mouseleave="hideDropdown"
                        >
                            <div v-if="notifications.length > 0">
                                <div
                                    v-for="notification in notifications"
                                    :key="notification.id"
                                    class="p-3 border-b cursor-pointer hover:bg-gray-100"
                                    :class="{
                                        'font-bold': !notification.status,
                                    }"
                                    @click="markAsRead(notification)"
                                >
                                    <h2>{{ notification.title }}</h2>
                                </div>
                            </div>
                            <p v-else class="p-3 text-gray-500 text-center">
                                Không có thông báo nào
                            </p>
                        </div>
                    </div>

                    <!-- Post Button -->
                    <router-link to="/post">
                        <button
                            class="rounded bg-blue-700 py-1.5 px-4 text-sm font-medium text-white hover:bg-blue-800 focus:ring-2 focus:ring-blue-500"
                        >
                            Đăng bài
                        </button>
                    </router-link>
                </div>

                <div
                    v-else
                    class="flex items-center space-x-3 mt-4 md:mt-0 md:order-2"
                >
                    <router-link to="/login">
                        <button
                            type="button"
                            class="rounded-lg border border-blue-700 py-1.5 px-4 text-center text-sm font-medium text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            Login
                        </button>
                    </router-link>
                    <router-link to="/register">
                        <button
                            type="button"
                            class="rounded-lg bg-blue-700 py-1.5 px-4 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                        >
                            Register
                        </button>
                    </router-link>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="mt-3 flex items-center justify-center space-x-4">
                <div
                    @click="toggleDropdown(index)"
                    v-for="(filter, index) in filters"
                    :key="index"
                    class="relative border flex items-center border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                >
                    <!-- Icon -->
                    <span :class="filter.icon" class="text-blue-500"></span>

                    <!-- Label hoặc Placeholder -->
                    <span v-if="filter.placeholder" class="text-sm">
                        {{ filter.placeholder }}
                    </span>
                    <span v-else class="text-sm">
                        <!-- Hiển thị giá trị đã chọn nếu có -->
                        {{ selectedFilters[filter.type] || filter.label }}
                    </span>

                    <!-- Dropdown Icon -->
                    <span class="material-icons">arrow_drop_down</span>

                    <!-- Dropdown Menu -->
                    <div
                        v-if="openDropdown === index && filter.data"
                        class="absolute top-full left-0 right-0 mt-2 w-52 max-h-40 bg-white border border-gray-300 rounded-lg shadow-lg z-10 overflow-y-auto"
                    >
                        <div
                            v-for="(item, i) in filter.data"
                            :key="i"
                            class="px-4 py-2 hover:bg-orange-100 cursor-pointer"
                            @click="selectFilter(item, filter.type)"
                        >
                            {{ item.name }}
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="bg-gray-200">
            <div class="container mx-auto p-4">
                <!-- Pricing Table -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h1 class="text-center text-2xl font-bold mb-4">
                        Bảng giá tin đăng
                    </h1>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full bg-white border border-gray-300"
                        >
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-2 border-r border-gray-300"
                                    >
                                        Loại
                                    </th>
                                    <th
                                        class="px-4 py-2 border-r border-gray-300 bg-blue-100"
                                    >
                                        Đẩy tin thường
                                    </th>
                                    <th
                                        class="px-4 py-2 border-r border-gray-300 bg-yellow-100"
                                    >
                                        Đẩy tin Premium
                                    </th>
                                    <th
                                        class="px-4 py-2 border-r border-gray-300 bg-red-100"
                                    >
                                        Quảng cáo banner
                                    </th>
                                    <th
                                        class="px-4 py-2 border-r border-gray-300 bg-pink-100"
                                    >
                                        Quảng cáo pop-up
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300"
                                    >
                                        Giá theo ngày
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-blue-100"
                                    >
                                        10.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-yellow-100"
                                    >
                                        40.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-red-100"
                                    >
                                        95.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-pink-100"
                                    >
                                        495.000VNĐ
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300"
                                    >
                                        Giá theo tuần
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-blue-100"
                                    >
                                        60.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-yellow-100"
                                    >
                                        280.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-red-100"
                                    >
                                        995.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-pink-100"
                                    >
                                        4.995.000VNĐ
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300"
                                    >
                                        Thanh toán tối thiểu
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-blue-100"
                                    >
                                        5.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-yellow-100"
                                    >
                                        20.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-red-100"
                                    >
                                        25.000VNĐ
                                    </td>
                                    <td
                                        class="px-4 py-2 border-t border-gray-300 bg-pink-100"
                                    >
                                        50.000VNĐ
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Illustration Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-center text-2xl font-bold mb-8">
                        Minh họa tin đăng
                    </h2>
                    <!-- Quảng cáo pop-up -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-2">Quảng cáo pop-up</h3>
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-500">
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                            </div>
                        </div>
                        <ul class="list-disc pl-5 mb-4">
                            <li>
                                Hiển thị ngay khi người dùng truy cập trang chủ
                                hoặc danh sách tin đăng.
                            </li>
                            <li>Hiển thị trên tất cả các thiết bị.</li>
                            <li>Thời gian hiển thị: 15 giây.</li>
                            <li>Không giới hạn số lần hiển thị.</li>
                            <li>
                                Giá hiển thị theo ngày và tuần sẽ thay đổi theo
                                từng thời điểm.
                            </li>
                        </ul>
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded"
                        >
                            Mua ngay
                        </button>
                        <div class="mt-4">
                            <img
                                alt="Laptop displaying a pop-up advertisement"
                                class="w-full max-w-md mx-auto"
                                height="400"
                                src="https://s3-alpha-sig.figma.com/img/3112/d10b/84cb9b38cce9bfc437da07b5d4c15d1d?Expires=1740960000&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=tXM2oLbbc~TVBQD3cW~YfbJbPPeGdExx0H8b8fjcLsI-Fz1v3~jdWXFBU2CYcBJCNGwDlSSw8XRCxFlIQsRdLPslxfH1dCDv~jXZhOIs3U5Lxx89WVCll1RMZcRb9Wjmf~iAXy81Kqi1zwrpNy2JX0UfA9tjQskSzIcQbCVmEHLI8NlAswgM8BxfE~w-hgUdxwZsL0-PsOuDs72CrSMxNW14YLIwtCa2QmkxkEP1ewrR4VCMAee0uA1cd5Rak1So5RJUCwDC1AEz41KSNmqzlF5fbxyzxBMmkSuQRpKxUrjUd-AFNrUZr4WSJYtdXP53qe81j-TEASXtZS63xUx~YA__"
                                width="600"
                            />
                        </div>
                    </div>
                    <!-- Quảng cáo banner -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-2">Quảng cáo banner</h3>
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-500">
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                            </div>
                        </div>
                        <ul class="list-disc pl-5 mb-4">
                            <li>
                                Hiển thị ở các vị trí cố định trên trang chủ,
                                trang danh sách tin đăng, và các bài viết.
                            </li>
                            <li>Hiển thị trên tất cả các thiết bị.</li>
                            <li>Thời gian hiển thị: 30 giây.</li>
                            <li>Không giới hạn số lần hiển thị.</li>
                            <li>
                                Giá hiển thị theo ngày và tuần sẽ thay đổi theo
                                từng thời điểm.
                            </li>
                        </ul>
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded"
                        >
                            Mua ngay
                        </button>
                        <div class="mt-4">
                            <img
                                alt="Laptop displaying a banner advertisement"
                                class="w-full max-w-md mx-auto"
                                height="400"
                                src="https://s3-alpha-sig.figma.com/img/e634/e6bf/a3915899116ace5464854815a597917c?Expires=1740960000&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=cgblSk~Q2hHT8Z1R~TR6hOsOsI2nBbI4MQ3tW5PZ4XUBZW6cN3e~ku5~aXh3LowW-ZE0zowVf0YJoRlANPh00gUF9~9F2e0907GyBGStv7SbqtIzT4ZLpivANhP2TBrZkzRA47sDoKy691KWUrnY1mcUbkA8hcwrFrevzD5hEFJsAP6EZL9bQbHLmAlzEYgBCzVeeuRF6lot37CC6PoQd8aOULNxFTaYYx7GVGz-hTSjKvrJtuJCKaoV1gDlmriTSn7YkdTZewQtVw5wd9nDogk3a99KmdpYrftglvDxtarDIvIBwlwPX9u4sJXAi-T-US~wYIctuQ2BYu1JY~Lj7A__"
                                width="600"
                            />
                        </div>
                    </div>
                    <!-- Đẩy tin premium -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-2">Đẩy tin premium</h3>
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-500">
                                <i>⭐</i>
                                <i>⭐</i>
                                <i>⭐</i>
                            </div>
                        </div>
                        <ul class="list-disc pl-5 mb-4">
                            <li>
                                Đưa tin đăng lên đầu danh sách trong mục tin
                                liên quan.
                            </li>
                            <li>
                                Hiển thị nổi bật và được người dùng dễ nhìn
                                thấy.
                            </li>
                            <li>Thời gian đẩy tin: 24 giờ.</li>
                            <li>
                                Không giới hạn số lần đẩy tin trong thời gian
                                hiển thị.
                            </li>
                        </ul>
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded"
                        >
                            Mua ngay
                        </button>
                        <div class="mt-4">
                            <img
                                alt="Laptop displaying a premium boosted post"
                                class="w-full max-w-md mx-auto"
                                height="400"
                                src="https://s3-alpha-sig.figma.com/img/10fe/6d03/1b76fd2bc68cea8de2d8a6f2f77356a2?Expires=1740960000&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=VBtzBbOrTqM6tcSQIGzA5~oClk-LRQSIf-GKCvqQZKH4U-BIcj6IKjq5HTgTm5CSpU845WXkfOnKyEWnINtekWbxTE7BWkyYvbUtYg5q9TlWKW-Uli0uONNveHO7rb59lzwDlz81Zs1taVoNT4e3jZqPwzvDmy13t3GHkqLESGDduFHUfz-4y8vGinYcbGpcyurfp9US2XpJAAGsLrMDfMxf5zynQwkpQnUFHRPeJhs33EbN4FobL9t-lGfVMOrBfgAA9ZKx72qS1stE6Zg60VCWvyQ0VuOsZH~ztO4MFyAwWmoMc2ik~F1hNcW2r93vUf6npe1bz6gcBmbEYRntFA__"
                                width="600"
                            />
                        </div>
                    </div>
                    <!-- Đẩy tin thông thường -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-2">
                            Đẩy tin thông thường
                        </h3>
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-500">
                                <i>⭐</i>
                                <i>⭐</i>
                            </div>
                        </div>
                        <ul class="list-disc pl-5 mb-4">
                            <li>
                                Giúp tin đăng xuất hiện trong danh sách "Tin nổi
                                bật" trong 3 ngày.
                            </li>
                            <li>
                                Hiển thị nổi bật và được người dùng dễ nhìn
                                thấy.
                            </li>
                            <li>
                                Không giới hạn số lần đẩy tin trong thời gian
                                hiển thị.
                            </li>
                        </ul>
                        <button
                            class="bg-blue-500 text-white px-4 py-2 rounded"
                        >
                            Mua ngay
                        </button>
                        <div class="mt-4">
                            <img
                                alt="Laptop displaying a regular boosted post"
                                class="w-full max-w-md mx-auto"
                                height="400"
                                src="https://s3-alpha-sig.figma.com/img/01b6/b8fe/bb9f99092fd9bbd1b107284144c7da9b?Expires=1740960000&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=goZ4d166gVZ~yePiscRHu19LenfepeC15Zt~PnYlX7VCM0gJR67Mf3Ol8FqCN63eJpHbWw1MdnN9f~N4UnGWIFIucHN8kFvLWNq8SyxPsuLTVpnQTIZTLaCZebXKvvLHXEj1RnHNCJDA4Rk0~6rduVpM31KDOhwyR8BSqP0wXOyMKUrQY8Mr2FXwULwmG~kb7USixj83gjDSabbQ~kWBlYkApwah1FQofo7eqvqukmk0OrgYdjkfZXQTzP16ziGPM1zUwIsckTUz6t-E7HaSK7mZtGqVxKRWieZtjUMlv5yJDONYdwqOQ0bW-h-iupOR2DHxZUzfLoj-bvvFU8Amnw__"
                                width="600"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="bg-primary text-white py-10">
            <div class="container mx-auto gap-8 px-4 flex justify-around">
                <!-- cột 1 + 2 -->
                <div class="flex justify-around max-w-6xl">
                    <!-- Cột 1 -->
                    <div class="">
                        <h3 class="text-lg font-semibold text-white mb-4">
                            VỀ AA+ HOME
                        </h3>
                        <ul class="space-y-2 text-white text-xs">
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Giới thiệu</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quý chế hoạt động</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quy định sử dụng</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Chính sách bảo mật</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Liên hệ</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Cột 2 -->
                    <div class="pl-14">
                        <h3 class="text-lg font-semibold text-white mb-4">
                            Dành cho khách hàng
                        </h3>
                        <ul class="space-y-2 text-white text-xs">
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Câu hỏi thường gặp</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Hướng dẫn đăng tin</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quy định đăng tin</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Bảng giá dịch vụ</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Hướng dẫn thanh toán</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Giải quyết khiếu nại</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cột 3 -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">
                        ĐĂNG KÍ ĐỂ NHẬN ƯU ĐÃI
                    </h3>
                    <p class="text-white mb-4">
                        Đăng ký để nhận ngay ưu đãi của AA++ HOME dành cho lần
                        thuê trọ đầu tiên!
                    </p>
                    <form class="flex flex-col space-y-3">
                        <input
                            type="email"
                            placeholder="EMAIL"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:outline-none"
                            required
                        />
                        <button
                            type="submit"
                            class="bg-gray-800 text-white py-2 rounded-md hover:bg-gray-900 transition"
                        >
                            ĐĂNG KÝ
                        </button>
                    </form>
                    <p class="mt-4 text-center text-gray-500 font-medium">
                        AA++ HOME
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import apiClient, { defaultApiClient } from "../axios";
import Pagination from "./Pagination.vue";
import loading from "./loading.vue";

export default {
    name: "Home",
    components: {
        Pagination,
        loading,
    },
    data() {
        return {
            selectedPost: null,
            showLoginModal: false,
            autoCloseTimeout: null, // Lưu ID của timeout
            is_select: "all",
            modalVisible: false,
            modalImages: [], // Mảng ảnh sẽ hiển thị trong modal
            currentImageIndex: 0, // Chỉ số ảnh hiện tại trong slide
            selectedFilters: {
                district: "",
                area: "",
                price: "",
                keyword: "",
            },
            debounceTimeout: null,

            openDropdown: null, // Trạng thái theo dõi dropdown đang mở
            showDropdown: false, // Điều khiển hiển thị menu dropdown

            notifications: [],
            showDropdownNotification: false,

            loading: false,
            user: null,
            showNoDataMessage: false,

            currentPage: 1, // Trang hiện tại
            itemsPerPage: 12, // Số sản phẩm mỗi trang
            totalPages: 6, // Số sản phẩm mỗi trang
            total: 0, // tổng trang
        };
    },
    computed: {
        unreadCount() {
            return this.notifications.filter((n) => !n.status).length;
        },
    },
    mounted() {
        // Kiểm tra và lấy user từ localStorage khi component được mount
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            this.user = JSON.parse(storedUser);
        }

        this.fetchNotifications();
    },
    methods: {
        navigateToRoute(event) {
            const selectedRoute = event.target.value;
            this.$router.push(selectedRoute);
        },
        openModal(images) {
            this.modalImages = images;
            this.currentImageIndex = 0; // Bắt đầu từ ảnh đầu tiên
            this.modalVisible = true;
        },
        closeModal() {
            this.modalVisible = false;
        },
        nextImage() {
            if (this.currentImageIndex < this.modalImages.length - 1) {
                this.currentImageIndex++;
            }
        },
        prevImage() {
            if (this.currentImageIndex > 0) {
                this.currentImageIndex--;
            }
        },
        toggleDropdown(index) {
            // Đóng nếu dropdown đang mở, mở nếu chưa mở
            this.openDropdown = this.openDropdown === index ? null : index;
        },
        toggleAvatarDropdown() {
            // Toggle hiển thị dropdown menu
            this.showDropdown = !this.showDropdown;
        },
        logout() {
            // Xử lý logic đăng xuất
            console.log("Đăng xuất");
            // Thực hiện các bước đăng xuất, ví dụ: gọi API, xóa token, chuyển hướng
            localStorage.removeItem("access_token");
            localStorage.removeItem("user");
            this.user = null;
            this.$router.push("/login");
        },

        showModal() {
            this.showLoginModal = true;

            // Hủy timeout cũ nếu có
            if (this.autoCloseTimeout) {
                clearTimeout(this.autoCloseTimeout);
            }

            console.log(this.autoCloseTimeout);

            // Đặt timeout để đóng modal sau 3 giây
            this.autoCloseTimeout = setTimeout(() => {
                this.closeModalError();
            }, 3000);

            console.log(this.autoCloseTimeout);
        },
        closeModalError() {
            this.showLoginModal = false;

            // Hủy timeout khi modal đóng
            if (this.autoCloseTimeout) {
                clearTimeout(this.autoCloseTimeout);
                this.autoCloseTimeout = null;
            }
        },

        async fetchLogout() {
            this.loading = true;
            try {
                const response = await defaultApiClient.post("/logout");
                localStorage.removeItem("user");
                localStorage.removeItem("access_token");
                this.user = null;
                window.location.reload();
            } catch (error) {
                console.error("Error logging out", error);
            } finally {
                this.loading = false; // Ẩn spinner
            }
        },

        handlePageChange(page) {
            this.currentPage = page;
            this.fetchRoomatesData(page); // Gọi lại API với trang mới
        },
        openPopup(post) {
            this.selectedPost = post;
        },
        async fetchNotifications() {
            console.log(localStorage.getItem("access_token"));

            console.log("Gọi API lấy thông báo...");
            try {
                const token = localStorage.getItem("access_token");
                if (!token) {
                    console.error("Token không tồn tại!");
                    return;
                }

                const res = await apiClient.get("/notifications", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                console.log(res.data.data);
                this.notifications = res.data.data;
                console.log("Dữ liệu thông báo:", this.notifications);
            } catch (error) {
                console.error("Lỗi khi lấy thông báo:", error);
            }
        },

        async markAsRead(notification) {
            if (!notification.status) {
                try {
                    const token = localStorage.getItem("access_token"); // Lấy token từ localStorage
                    await apiClient.patch(
                        `/notifications/${notification.id}/read`,
                        {},
                        {
                            headers: {
                                Authorization: `Bearer ${token}`,
                            },
                        }
                    );
                    notification.status = true;
                } catch (error) {
                    console.error("Lỗi khi đánh dấu thông báo:", error);
                }
            }
        },

        hideDropdown() {
            setTimeout(() => {
                this.showDropdownNotification = false;
            }, 300);
        },
    },
};
</script>
