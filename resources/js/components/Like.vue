<script setup>
import { ref } from "vue";

const props = defineProps([
    "like_count",
    "php_class",
    "id",
    "post",
    "model",
    "like",
    "model_url",
    "auth",
]);

let count = ref(props.like_count);
let liked = ref(props.like);

async function like() {
    try {
        const res = await axios.post("/like", {
            id: props.id,
            class: props.php_class,
            url: props.model_url,
        });
        liked.value = true;
        count.value++;
        console.log(res.data.message);
    } catch (e) {
        console.log(e);
    }
}

async function unlike() {
    let url = "/like",
        urlWithParams = `${url}?id=${props.id}&class=${props.php_class}`;

    try {
        const res = await axios.delete(urlWithParams);
        liked.value = false;
        count.value--;
        console.log(res.data.message);
    } catch (e) {
        console.log(e);
    }
}
</script>

<template>
    <div>
        <span style="color: hsl(214, 75%, 45%)" v-if="count > 0"
            >{{ count }} <span>like<span v-if="count > 1">s</span></span></span
        >

        <span v-if="auth">
            <span v-if="!liked">
                <button
                    @click.once="like()"
                    class="ml-3 tex-xl text-green-400 underline"
                >
                    like
                </button>
            </span>

            <span v-if="liked">
                <button
                    type="submit"
                    @click.once="unlike()"
                    class="ml-3 tex-xl text-green-400 underline"
                >
                    unlike
                </button>
            </span>
        </span>
    </div>
</template>
