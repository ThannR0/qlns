<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-black py-16 px-8 text-center shadow-md">
      <h1 class="text-4xl font-bold mb-4">Giới thiệu Hệ thống Quản lý Nhân sự</h1>
      <p class="text-lg max-w-2xl mx-auto leading-relaxed">
        Giải pháp giúp doanh nghiệp quản lý nhân sự hiệu quả,
        và nâng cao năng suất làm việc trong kỷ nguyên số.
      </p>
    </section>

    <!-- Main Content -->
    <section class="container mx-auto px-6 py-12 grid md:grid-cols-2 gap-12">
      <!-- Left: Introduction -->
      <div>
        <h2 class="text-2xl font-semibold text-blue-700 mb-4">Tổng quan hệ thống</h2>
        <p class="text-gray-700 leading-relaxed mb-4">
          Hệ thống <strong>Quản lý Nhân sự Doanh nghiệp</strong> được phát triển nhằm hỗ trợ 
          các phòng ban trong việc lưu trữ và quản lý thông tin nhân viên, chấm công, lương thưởng, 
          và thời gian làm việc của nhân viên.
        </p>
        <p class="text-gray-700 leading-relaxed mb-6">
          Với giao diện trực quan, thân thiện và công nghệ hiện đại, hệ thống mang đến trải nghiệm 
          dễ sử dụng cho cả người quản lý và nhân viên.
        </p>

        <ul class="list-disc list-inside text-gray-700 space-y-2">
          <li>Quản lý hồ sơ nhân viên, phòng ban, chức vụ.</li>
          <li>Tích hợp chấm công và tính lương cho HR</li>
          <li>Phân quyền chi tiết các role, bảo mật dữ liệu an toàn.</li>
        </ul>
      </div>

      <!-- Right: Illustration -->
      <div class="flex items-center justify-center">
        <img
          src="https://cdn-icons-png.flaticon.com/512/3206/3206921.png"
          alt="Human Resource Management Illustration"
          class="w-3/4 max-w-md drop-shadow-lg rounded-2xl"
        />
      </div>
    </section>

    <!-- Feature Highlights -->
    <section class="bg-white py-12 shadow-inner">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-2xl font-semibold text-blue-700 mb-8">Tính Năng Nổi Bật</h2>

        <div class="grid md:grid-cols-3 gap-8">
          <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-md transition">
            <h3 class="text-xl font-semibold text-blue-700 mb-3">Quản Lí Hồ Sơ</h3>
            <p class="text-gray-600">Quản Lí Thông Tin Nhân Viên, Hợp Đồng Và Bảo Hiểm</p>
          </div>

          <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-md transition">
            <h3 class="text-xl font-semibold text-blue-700 mb-3">Chấm công & Lương</h3>
            <p class="text-gray-600">Nhân Viên Chấm Công Rõ Ràng, Nhận Lương Với Hệ Số Minh Bạch</p>
          </div>

          <div class="bg-blue-50 p-6 rounded-2xl shadow hover:shadow-md transition">
            <h3 class="text-xl font-semibold text-blue-700 mb-3">Xuất File Excel Thông Tin Nhân Viên Nhanh Chóng</h3>
            <p class="text-gray-600">Quy Trình Nghiệp Vụ Quản Lí Rành Mạch</p>
          </div>
        </div>
      </div>
    </section>

  <!-- Call To Action -->
  <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-black py-12 text-center">
    <h2 class="text-2xl font-semibold mb-4">Chấm Công Để Bắt Đầu Một Ngày Làm Việc Năng Suất!</h2>  
        <p class="text-gray-700 leading-relaxed mb-6">
          CHÚC BẠN MỘT NGÀY LÀM VIỆC VUI VẺ!
        </p>
  </section>

  </div>
</template>



<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
}
</script>
