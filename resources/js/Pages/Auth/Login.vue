<template>
  <div
    class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex justify-center items-center p-6">
    <div class="w-full max-w-md animate-fade-in">


      <form class="mt-8 bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden"
        @submit.prevent="login">
        <div class="flex justify-center mt-6 mb-4">
          <logo class="w-20 h-20 fill-white drop-shadow-xl" />
        </div>
        <div class="px-10 py-12">
          <h1 class="text-center font-bold text-3xl text-white tracking-wide">Đăng Nhập</h1>
          <p class="text-center text-gray-300 text-sm mt-2">Hệ thống quản lý doanh nghiệp</p>

          <div class="mx-auto mt-6 w-24 border-b-2 border-indigo-400" />

          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Email" type="email" autofocus
            autocapitalize="off" />

          <div class="mt-6 w-full">
            <label class="block text-white mb-1">Mật khẩu</label>
            <div
              class="flex items-center border border-gray-300 rounded-md overflow-hidden bg-black backdrop-blur-sm">
              <input v-model="form.password" :type="showPassword ? 'text' : 'password'"
                class="flex-1 px-3 py-2 bg-white text-black placeholder-gray-300 outline-none text-sm"
                placeholder="Nhập mật khẩu" autocomplete="new-password" />
              <!-- Nút Hiện/Ẩn với icon căn cao bằng input -->
              <button type="button" @click="showPassword = !showPassword"
                class="flex items-center justify-center px-3 h-full text-gray-400 hover:text-white transition-colors duration-200">
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
            <p v-if="form.errors.password" class="mt-1 text-red-500 text-sm">{{ form.errors.password }}</p>
          </div>




          <label class="mt-6 select-none flex items-center text-gray-300" for="remember">
            <input id="remember" v-model="form.remember" class="mr-2 rounded" type="checkbox" />
            <span class="text-sm">Ghi nhớ đăng nhập</span>
          </label>
        </div>

        <div class="px-10 py-4 bg-black/20 border-t border-white/10 flex">
          <loading-button :loading="form.processing"
            class="ml-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow-lg transition duration-200"
            type="submit">
            Đăng Nhập
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  metaInfo: { title: 'Login' },
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: 'admin@email.com',
        password: '123',
        remember: false,
      }),
      showPassword: false,
    }
  },
  methods: {
    login() {
      this.form.post(this.route('login.store'))
    },
  },
}
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(15px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.6s ease-out;
}

label {
  color: white !important;
}

:deep(label) {
  color: white !important;
}
</style>
