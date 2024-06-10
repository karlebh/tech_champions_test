<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";

const picture = ref("");

async function profilePicture() {
    const pic = document.querySelector("#picture");
    try {
        const [data] = await axios.post("/profile-picture", {
            pic: pic.value.replace("C:\\fakepath\\", ""),
        });
        console.log(data, 1);
    } catch (e) {}
}

function hello() {
    let pic = document.querySelector("#picture");
    pic = pic.value.replace("C:\\fakepath\\", "");
    console.log(pic);

    let show = document.querySelector("#show");
    show.src = pic;
    console.log(show);
}

onMounted(() => {
    profilePicture();
});
</script>

<template>
    <div class="my-1">
        <img src="" alt="" id="show" />

        <!-- <form
            action="/profileImage"
            enctype="multipart/form-data"
            method="post"
        > -->
        <input
            type="file"
            @change="hello()"
            name="picture"
            value=""
            id="picture"
            accept="image/*"
        />
        <!-- </form> -->
    </div>
</template>
