<script setup>
import { ref } from "vue";

const props = defineProps(["url", "follows", "follows_back"]);
const follows = ref(Boolean(props.follows));
const follows_back = ref(Boolean(props.follows_back));

async function follow(action) {
    try {
        await axios.post(props.url);
        switch (action) {
            case "followed":
                follows.value = !follows.value;
                break;
            case "unfollowed":
                follows_back.value = !follows_back.value;
                follows.value = !follows.value;
                break;
            case "followed_back":
                follows_back.value = !follows_back.value;
                follows.value = !follows.value;
                break;
            default:
                break;
        }
    } catch (e) {
        console.log(e);
    }
}
</script>

<template>
    <div class="space-4 text-white">
        <button
            v-if="!follows && !follows_back"
            @click.prevent="follow('followed')"
            style="background-color: rgb(74, 222, 128)"
            class="p-4 rounded-md"
        >
            Follow
        </button>
        <button
            @click.prevent="follow('unfollowed')"
            v-if="follows && !follows_back"
            style="background-color: black"
            class="p-4 rounded-md"
        >
            Unfollow
        </button>

        <button
            @click.prevent="follow('followed_back')"
            v-if="follows_back"
            style="background-color: rgb(60, 60, 165)"
            class="p-4 rounded-md"
        >
            Follow Back
        </button>
    </div>
</template>
