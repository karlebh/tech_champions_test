<script setup>
import { defineProps, ref } from "vue";
const props = defineProps(["box_id"]);

let ids = {};

if (!localStorage.getItem("ids")) {
    localStorage.setItem("ids", JSON.stringify({}));
    ids = JSON.parse(localStorage.getItem("ids"));
} else {
    ids = JSON.parse(localStorage.getItem("ids"));
}

// console.log(ids);

const id = ids[`box_${props.box_id}`] ?? false;

const box = document.getElementById(`commentBox-${props.box_id}`);
console.log(box);

function hideCommentBox() {
    box.classList.toggle("hidden");
}
</script>

<template>
    <button class="my-2" :id="props.box_id" @click="hideCommentBox">
        Hide Comment Box
    </button>
</template>
