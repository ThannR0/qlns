<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('users')">Người Dùng</inertia-link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ user.hovaten }}
      </h1>
    </div>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore">
      Người dùng này đã bị xoá.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="user.hovaten" class="pr-6 pb-8 w-full lg:w-1/2" label="Họ và tên" disabled />
          <text-input :disabled="$page.props.auth.user.role == 2 ? false : true" v-model="form.email"
            :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <select-input :disabled="$page.props.auth.user.role == 2 ? false : true" v-model="form.role"
            :error="form.errors.role" class="pr-6 pb-8 w-full lg:w-1/2" label="Quyền hạn">
            <option :value="0">Người dùng</option>
            <option :value="1">Quản lý</option>
            <option :value="2">Quản trị viên</option>
          </select-input>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="block text-gray-700 mb-1">Mật khẩu</label>
            <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
              <input v-model="form.password" :type="showPassword ? 'text' : 'password'"
                class="flex-1 px-3 py-2 outline-none" autocomplete="new-password" />
              <button type="button" @click="showPassword = !showPassword"
                class="px-3 text-blue-600 text-sm select-none">
                <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.965 9.965 0 012.182-3.422m3.414-2.172A9.954 9.954 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.965 9.965 0 01-4.247 4.747M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                </svg>
              </button>
            </div>
            <p v-if="form.errors.password" class="mt-1 text-red-500 text-sm">
              {{ form.errors.password }}
            </p>
          </div>


        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!user.deleted_at && $page.props.auth.user.role == 2 && $page.props.auth.user.id != user.id"
            class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Xoá Người Dùng</button>
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
      title: `${this.user.hovaten}`,
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
    user: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        email: this.user.email,
        password: null,
        role: this.user.role
      }),
      showPassword: false,
    }
  },
  methods: {
    update() {
      this.form.post(this.route('users.update', this.user.id), {
        onSuccess: () => this.form.reset('password')
      })
    },
    destroy() {
      if (confirm('Bạn có chắc chắn muốn xoá không?')) {
        this.$inertia.delete(this.route('users.destroy', this.user.id))
      }
    },
    restore() {
      if (confirm('Bạn có chắc chắn muốn khôi phục không?')) {
        this.$inertia.put(this.route('users.restore', this.user.id))
      }
    },
  },
}
</script>
