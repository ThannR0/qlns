<template>

  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('nhanluong')">Nhận Lương</inertia-link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ nhanluong.hovaten }}
      </h1>
    </div>
    <trashed-message v-if="nhanluong.deleted_at" class="mb-6" @restore="restore">
      Nhận lương này đã bị xoá.
    </trashed-message>
<div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 mt-4 grid md:grid-cols-2 gap-6">
  <div>
    <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
      🧮 <span>Công thức tính lương thực lĩnh</span>
    </h3>
    <div class="text-sm text-gray-700 leading-relaxed">
      <p>
        <b>Thực lĩnh</b> =
        (<span class="font-medium text-blue-600">Mức lương</span>+
        <span class="font-medium text-blue-600">Lương phụ cấp)</span> ÷
        <span class="font-medium text-blue-600">(Ngày công chuẩn</span> *
        (<span class="font-medium text-blue-600">Ngày công</span> +
        <span class="font-medium text-blue-600">Ngày nghỉ hưởng lương</span>))
      </p>
      <p class="mt-1">
        + <span class="font-medium text-green-600">Thưởng</span>
        − <span class="font-medium text-red-600">Phạt</span>
        − <span class="font-medium text-red-600">Tạm ứng</span>
        − <span class="font-medium text-red-600">Thuế</span>
        − <span class="font-medium text-red-600">Khấu trừ(%)</span>
      </p>
      <p class="mt-1">
        🧩 <span class="font-medium text-blue-600">Lương phụ cấp = (Hệ số phụ cấp × Phụ cấp)</span>
      </p>
      <p class="mt-1">
        🧩 <span class="font-medium text-blue-600">Mức lương = (Lương cơ bản × Hệ số lương)</span>
      </p>
      <p class="mt-1">
        🧩 <span class="font-medium text-blue-600">Ngày nghỉ không lương = (Ngày công chuẩn - Ngày công thực tế) - Ngày nghỉ</span>
      </p>
    </div>
  </div>

  <div class="border-l border-gray-300 pl-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
      💡 <span>Lưu ý</span>
    </h3>

    <div class="mt-3 text-sm text-gray-600 italic">
      - Ngày công chuẩn là số ngày mặc định trong tháng nhân viên phải đi làm đúng. Nếu nghỉ bất cứ ngày công chuẩn
      nào sẽ không được nhận lương.
    </div>

    <div class="mt-3 text-sm text-gray-600 italic">
      - Thuộc tính <b>khấu trừ(%)</b> được tính từ phí của công ty qua các tháng và chi phí giấy tờ.
    </div>

    <div class="mt-3 text-sm text-gray-600 italic">
      - Thuộc tính <b>thuế</b> được tự động fill vào từ phí thực lĩnh nhận được trong tháng khi tạo nghiệm thu lương:
    </div>

    <div class="ml-4 mt-2 text-gray-500 not-italic space-y-1">
      <p>💵 Dưới 5.000.000 VND → Thuế <b>5%</b></p>
      <p>💵 5.000.000 – 10.000.000 VND → Thuế <b>10%</b></p>
      <p>💵 10.000.000 – 18.000.000 VND → Thuế <b>15%</b></p>
      <p>💵 18.000.000 – 32.000.000 VND → Thuế <b>20%</b></p>
      <p>💵 32.000.000 – 52.000.000 VND → Thuế <b>25%</b></p>
      <p>💵 52.000.000 – 80.000.000 VND → Thuế <b>30%</b></p>
      <p>💵 > 80.000.000 VND → Thuế <b>35%</b></p>
    </div>
  </div>
</div>

    <div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.ngaynhan" :error="form.errors.ngaynhan" class="pr-6 pb-8 w-full lg:w-1/2"
            type="month" label="Tháng nhận" />
          <text-input v-model="form.ngaycongchuan" :error="form.errors.ngaycongchuan" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Ngày công chuẩn" />
          <text-input v-model="form.heso" :error="form.errors.heso" class="pr-6 pb-8 w-full lg:w-1/2"
            label="Hệ số lương(%)" />
          <text-input v-model="form.hsphucap" :error="form.errors.hsphucap" class="pr-6 pb-8 w-full lg:w-1/2"
            label="Hệ số phụ cấp(%)" />
          <text-input v-model="form.khautru" :error="form.errors.khautru" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Khẩu trừ(VND)" />
          <text-input v-model="form.luongcb" :error="form.errors.luongcb" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Lương cơ bản(VND)" disabled />
          <text-input v-model="form.phucap" :error="form.errors.phucap" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Phụ cấp(VND)" disabled />
          <text-input v-model="form.mucluong" :error="form.errors.mucluong" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Mức lương(VND)" />
          <text-input v-model="form.ngaycong" :error="form.errors.ngaycong" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Ngày công thực tế" />
          <text-input v-model="form.nghihl" :error="form.errors.nghihl" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Ngày nghỉ hưởng lương" />
          <text-input v-model="form.nghikhl" :error="form.errors.nghikhl" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Ngày nghỉ không hưởng lương" />
          <text-input v-model="form.thuong" :error="form.errors.thuong" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Tiền thưởng(VND)" />
          <text-input v-model="form.phat" :error="form.errors.phat" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Tiền phạt(VND)" />
          <text-input v-model="form.tamung" :error="form.errors.tamung" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Tạm ứng(VND)" />
          <text-input v-model="form.thue" :error="form.errors.thue" class="pr-6 pb-8 w-full lg:w-1/2" type="number"
            label="Thuế(VND)" disabled />
          <text-input v-model="form.thuclinh" :error="form.errors.thuclinh" class="pr-6 pb-8 w-full lg:w-1/2"
            type="number" label="Thực lĩnh(VND)" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!nhanluong.deleted_at && $page.props.auth.user.role == 2" class="text-red-600 hover:underline"
            tabindex="-1" type="button" @click="destroy">Xoá Nhận Lương</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Cập Nhật</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  metaInfo() {
    return {
      title: `${this.nhanluong.hovaten}`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    nhanluong: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        heso: this.nhanluong.heso.toString(),
        hsphucap: this.nhanluong.hsphucap.toString(),
        khautru: this.nhanluong.khautru,
        luongcb: this.nhanluong.luongcb,
        mucluong: this.nhanluong.mucluong,
        phucap: this.nhanluong.phucap,
        ngaycongchuan: this.nhanluong.ngaycongchuan,
        ngaycong: this.nhanluong.ngaycong,
        nghihl: this.nhanluong.nghihl,
        nghikhl: this.nhanluong.nghikhl,
        thuong: this.nhanluong.thuong,
        phat: this.nhanluong.phat,
        tamung: this.nhanluong.tamung,
        thue: this.nhanluong.thue,
        thuclinh: this.nhanluong.thuclinh,
        ngaynhan: this.nhanluong.ngaynhan,
      })
    }
  },
  methods: {
    update() {
      this.form.post(this.route('nhanluong.update', this.nhanluong.id))
    },
    destroy() {
      if (confirm('Bạn có chắc chắn muốn xoá không?')) {
        this.$inertia.delete(this.route('nhanluong.destroy', this.nhanluong.id))
      }
    },
    restore() {
      if (confirm('Bạn có chắc chắn muốn khôi phục không?')) {
        this.$inertia.put(this.route('nhanluong.restore', this.nhanluong.id))
      }
    },
  },
}
</script>
