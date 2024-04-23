<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
defineProps({user: Object});

const page = usePage();

onMounted(() => {
    console.log(page.props.auth);
})
const followUser = (id) => {
    router.post(route('follow'), {following_id: id});
}

</script>

<template>
    <div class="bg-white p-4 rounded shadow flex items-center justify-between w-80 absolute" :class>
        <div>
            <h3 class="text-xl font-bold">{{ user.user.name }}</h3>
            <p class="text-gray-400">{{ user.followersCount}} follower</p>
        </div>
        <!-- <PrimaryButton>follow</PrimaryButton> -->
            <PrimaryButton @click="followUser(user.user.id)" v-if="user.user.id != page.props.auth.user.id">Follow</PrimaryButton>
    </div>
</template>
