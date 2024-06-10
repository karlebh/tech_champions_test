<script setup>
import axios from "axios";
import { reactive, ref } from "vue";

const error = ref({});
const current_password = ref("");
const password = ref("");
const password_confirmation = ref("");

const data2 = reactive({
    current_password: "",
    password: "",
});

async function changePassword() {
    try {
        await axios.put("password", {
            // current_password: current_password.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });
    } catch (error) {
        console.log(error.response.message);
    }
}
</script>

<template>
    <div>
        <!-- <div>
            <label for="current_password">Current Password</label>
            <input
                id="current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full rounded"
                autocomplete="current-password"
                v-model="current_password"
            />
            <div>error</div>
        </div> -->

        <div>
            <label for="password">New Password</label>
            <input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-full rounded"
                autocomplete="new-password"
                v-model="password"
            />
            <div>error</div>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full rounded"
                autocomplete="new-password"
                v-model="password_confirmation"
            />
            <div>error</div>
        </div>

        <div class="flex items-center gap-4">
            <button
                style="background-color: rgb(84, 163, 84)"
                class="px-5 py-2 text-white rounded"
                @click.prevent="changePassword()"
            >
                Save
            </button>

            <!-- session('status') === 'password-updated' -->
            <!-- <p class="text-sm text-gray-600 dark:text-gray-400">Saved</p> -->
        </div>
    </div>
</template>
