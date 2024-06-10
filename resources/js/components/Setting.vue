<script setup>
import axios from "axios";
import { ref } from "vue";

const props = defineProps(["setting", "type"]);

const mention_notifiable = ref(Boolean(props.setting.mention_notifiable));
const like_notifiable = ref(Boolean(props.setting.like_notifiable));
const follow_notifiable = ref(Boolean(props.setting.follow_notifiable));
const comment_notifiable = ref(Boolean(props.setting.comment_notifiable));

async function toggleSetting(model) {
    try {
        await axios.put(`/settings/${props.setting.user_id}`, model);
    } catch (e) {}
}
</script>

<template>
    <div class="">
        <div class="">
            <label for="mention_notifiable" class="cursor-pointer">
                <slot></slot>
                <input
                    v-if="props.type === 'mention_notifiable'"
                    type="checkbox"
                    v-model="mention_notifiable"
                    class="w-16 h-16 mt-5 rounded-full transition-all duration-700 block"
                    @change="
                        toggleSetting({
                            mention_notifiable,
                        })
                    "
                />
            </label>
            <label for="like_notifiable" class="cursor-pointer">
                <input
                    v-if="props.type === 'like_notifiable'"
                    type="checkbox"
                    v-model="like_notifiable"
                    class="w-16 h-16 mt-5 rounded-full transition-all duration-700 block"
                    @change="
                        toggleSetting({
                            like_notifiable,
                        })
                    "
                />
            </label>
            <label for="follow_notifiable" class="cursor-pointer">
                <input
                    v-if="props.type === 'follow_notifiable'"
                    type="checkbox"
                    v-model="follow_notifiable"
                    class="w-16 h-16 mt-5 rounded-full transition-all duration-700 block"
                    @change="
                        toggleSetting({
                            follow_notifiable,
                        })
                    "
                />
            </label>
            <label class="cursor-pointer">
                <input
                    v-if="props.type === 'comment_notifiable'"
                    type="checkbox"
                    v-model="comment_notifiable"
                    class="w-16 h-16 mt-5 rounded-full transition-all duration-700 block"
                    @change="
                        toggleSetting({
                            comment_notifiable,
                        })
                    "
                />
            </label>
        </div>
    </div>
</template>
