import "./bootstrap";
import "../../public/js/karleb";
import { createApp, ref } from "vue";

import Like from "./components/Like.vue";
import Try from "./components/Try.vue";
import Search from "./components/Search.vue";
import Follow from "./components/Follow.vue";
import Message from "./components/Message.vue";
import Setting from "./components/Setting.vue";
import ProfilePicture from "./components/ProfilePicture.vue";
import ProfileDetails from "./components/ProfileDetails.vue";
import DeleteProfileImage from "./components/DeleteProfileImage.vue";
import ChangePassword from "./components/ChangePassword.vue";
import ToggleCommentBox from "./components/ToggleCommentBox.vue";

const app = createApp({});

app.component("try-component", Try);
app.component("Like", Like);
app.component("Search", Search);
app.component("Follow", Follow);
app.component("Message", Message);
app.component("ProfilePicture", ProfilePicture);
app.component("ProfileDetails", ProfileDetails);
app.component("Setting", Setting);
app.component("DeleteProfileImage", DeleteProfileImage);
app.component("ChangePassword", ChangePassword);
app.component("ToggleCommentBox", ToggleCommentBox);

app.mount("#app");
