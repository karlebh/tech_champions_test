<script setup>
import { ref } from "vue";

const p = ref("");
const url = `/search/${p.value}`;
let results = ref([]);

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        if (!timer) {
            func.apply(this, args);
        }
        clearTimeout(timer);
        timer = setTimeout(() => {
            timer = undefined;
        }, timeout);
    };
}
async function getResult() {
    if (p.value.length >= 2) {
        try {
            const { data } = await axios.post(url, {
                p: p.value,
            });
            results.value = data[0];
            console.log(results.value);
        } catch (e) {
            results.value = [];
        }
    }
}

results.value = [];

const debounceResult = debounce(getResult, 500);

function getUrl(url) {
    return `/post/${url}`;
}

function clear() {
    results.value = [];
    p.value = "";
}
</script>

<template>
    <div class="relative z-20">
        <div class="flex space-x-2 items-center">
            <input
                placeholder="Search for posts"
                class="w-full lg:w-full search"
                type="text"
                v-model="p"
                v-on:input="debounceResult"
            />
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                style="border: 1px"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 cursor-pointer"
                v-if="p.length >= 3"
                @click="
                    results = [];
                    p = '';
                "
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18 18 6M6 6l12 12"
                />
            </svg>
        </div>
        <div
            class="fixed inset-0 w-full h-full z-30"
            style="background-color: transparent"
            v-if="results.length && p !== ''"
            @click="clear"
        ></div>
        <div
            v-if="results.length"
            class="absolute overflow-y-auto w-full bg-gray-200 py-2 mt-2"
            style="height: 30rem"
        >
            <template v-for="result in results">
                <a :href="getUrl(result.slug)" class="">
                    <div
                        class="flex py-3 bg-gray-200 hover:bg-gray-100 p-3 duration-75"
                    >
                        {{ result.title }}
                    </div></a
                >
            </template>
        </div>
    </div>
</template>

<style scoped>
.search {
    border-right: 0;
    outline: 0;
}

.search:focus,
.search:active {
    outline: 0;
}
</style>
