<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const {userId} = defineProps(['userId'])
const page = usePage();
const user = ref({});

console.log(userId);

const fetchUser = async (userId) => {
    const response = await axios.get(route('getUser', userId));
    user.value = response.data;
    console.log(user.value);
}

onMounted(() => {
    fetchUser(userId);
})

const followUser = async (id) => {
    const response = await axios.post(route('follow'), {following_id : id})
    user.value = response.data;
}

</script>

<template>
    <div class="bg-white p-4 rounded shadow flex items-center justify-between w-80 absolute" :class >
        <div v-if="JSON.stringify(user) == '{}'">
            Loading ...
        </div>

        <template v-else>
            <div>
                <h3 class="text-xl font-bold">{{ user.user.name }}</h3>
                <p class="text-gray-400">{{ user.followersCount}} follower</p>
            </div>
            <!-- <PrimaryButton>follow</PrimaryButton> -->
            <PrimaryButton @click="followUser(user.user.id)" v-if="user.user.id != page.props.auth.user.id">Follow</PrimaryButton>
        </template>
    </div>
</template>
