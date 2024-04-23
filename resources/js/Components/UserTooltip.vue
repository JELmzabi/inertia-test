<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
defineProps({user: Object});

</script>

<template>
    <div class="bg-white p-4 rounded shadow flex items-center justify-between w-80 absolute" :class>
        <div>
            <h3 class="text-xl font-bold">{{ user.name }}</h3>
            <p class="text-gray-400">{{ user.followersCount ?? '0' }} follower</p>
        </div>
        <!-- <Prima>follow</PrimaryButton> -->
            <PrimaryButton>Follow</PrimaryButton>
    </div>
</template>
