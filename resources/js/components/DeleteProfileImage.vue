<script setup>
import axios from "axios";

const props = defineProps(["user"]);

async function deleteProfilePicture() {
    if (!confirm("Are you sure you want to delete your profile picture"))
        return;

    const pic = document.querySelector("#profile-picture");

    try {
        const res = await axios.delete(`/profile-image/${props.user.id}`);
        pic.remove();
    } catch (error) {
        console.log(error);
    }
}
</script>

<template>
    <div>
        <button
            class="text-gray-100 rounded px-3 py-2 bg-red-500 my-4 block"
            type="submit"
            @click="deleteProfilePicture"
        >
            Delete Profile Image
        </button>
    </div>
</template>
