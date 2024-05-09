<template>
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                alt="Your Company" />
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" @submit.prevent="login" action="" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="text" autocomplete="email"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            v-model="emailValue" />
                        <p v-if="arrayErrorMessages.email" class="text-red-600">
                            *{{ arrayErrorMessages.email }}
                        </p>
                        <p v-if="arrayErrorMessages.message" class="text-red-600">
                            *{{ arrayErrorMessages.message }}
                        </p>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            v-model="passwordValue"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        <p v-if="arrayErrorMessages.password" class="text-red-600">
                            *{{ arrayErrorMessages.password }}
                        </p>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                {{ ' ' }}
                <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a 14 day free
                    trial</a>
            </p>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { handleFormError } from '@/helper/helper.js'

export default {
    setup() {
        const emailValue = ref('')
        const passwordValue = ref('')
        let arrayErrorMessages = ref({})
        const router = useRouter()
        const authStore = useAuthStore()
        const login = async () => {
            try {
                await authStore.login(emailValue.value, passwordValue.value)
                toast.success('Đăng nhập thành công');
                setTimeout(() => {
                    router.push({ name: 'dashboard' })
                }, 2000);
            } catch (error) {
                handleFormError(error, arrayErrorMessages)
            }
        }

        return { emailValue, passwordValue, login, arrayErrorMessages }
    }
}
</script>
