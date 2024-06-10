<script setup>
import { ref } from "vue";

let body = ref("look");
const messages = ref([]);

const props = defineProps(["sender_id", "receiver_id"]);
const channel = window.Echo.channel("chat");

async function sendMessage() {
    channel.listen(".chat", (e) => {
        // console.log(e);
        messages.value.push(e.message);
    });

    const data = {
        body: body.value,
        receiver_id: props.receiver_id,
    };
    const res = await axios.post("/message", data);

    // console.log(messages.value);
}
</script>

<template>
    <div>
        <p class="text-sm text-blue-600">Chat with this user in real time</p>
        <div class="flex items-baseline gap-x-4">
            <textarea v-model="body" id="" cols="30" rows="3"></textarea>

            <div>
                <button
                    style="background-color: black"
                    class="bg-black p-3 text-white"
                    @click.prevent="sendMessage"
                >
                    Send Message
                </button>
            </div>
        </div>

        <div class="rounded border-blue-500 p-10">
            <div v-for="(message, index) in messages">
                <div :data-id="index">{{ message }}</div>
            </div>
        </div>
    </div>
</template>
