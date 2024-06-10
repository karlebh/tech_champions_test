<script setup>
import { ref, watch } from "vue";

const props = defineProps([
    "user",
    "profile_updated",
    "userNotVerified",
    "verification_link_sent",
]);

const name = ref(props.user.name);
const email = ref(props.user.email);
const errors = ref({});
const show = ref(false);

async function updateProfile() {
    try {
        const res = await axios.patch("/profile", {
            name: name.value,
            email: email.value,
        });
        show.value = !show.value;
        setTimeout(() => (show.value = false), 700);
    } catch (e) {
        errors.value = e.response.data.errors;
    }
}
</script>

<template>
    <div>
        <p class="text-red-400" v-if="errors.length">{{ errors }}</p>
        <div>
            <label for="name" value="Name"></label>

            <input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full rounded"
                v-model="name"
                required
                autofocus
                autocomplete="name"
            />
            <div class="mt-2" v-for="error in errors['name']" :key="error">
                {{ error }}
            </div>
        </div>

        <label for="email" value="__('Email')"></label>
        <input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full rounded"
            v-model="email"
            required
            autocomplete="username"
        />
        <div class="mt-2" v-for="error in errors['email']" :key="error">
            {{ error }}
        </div>

        <div v-if="props.userNotVerified">
            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                "Your email address is unverified."

                <button
                    form="send-verification"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    {{ "Click here to re-send the verification email." }}
                </button>
            </p>
        </div>

        <div v-if="props.verification_link_sent">
            <p
                class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
            >
                {{
                    " A new verification link has been sent to your email address."
                }}
            </p>
        </div>

        <button @click.prevent="updateProfile()">
            <slot></slot>
        </button>

        <div class="flex items-center gap-4">
            <p v-if="show" class="text-sm text-gray-600 dark:text-gray-400">
                {{ "Saved." }}
            </p>
        </div>
    </div>
</template>
