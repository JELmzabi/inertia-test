<script setup>
import UserTooltip from './UserTooltip.vue';
defineProps(['id', 'path', 'title', 'tags', 'author', 'posted_since', 'user', 'fetchUser']);

</script>

<template>
    <div class="p-5 rounded bg-white">
        <div class="mb-6 w-full h-60 rounded bg-cover" :style="{backgroundImage: 'url(' + path + ')'}">
            <!-- <img :src="path" alt="" srcset="" class="rounded block max-h-full max-w-full"> -->
        </div>
        <h3 class="text-lg font-bold mb-1">{{ title }}</h3>
        <p>{{ bgImg }}</p>
        <!-- Not implemented yet -->
        <!-- <ul class="flex items-center space-x-2 mb-4" v-if="tags">
            <li class="px-2 rounded bg-blue-100" v-for="tag in tags" :key="tag">{{ tag }}</li>
        </ul> -->
        <div class="flex justify-between relative">
            <p class="underline cursor-pointer" @click="fetchUser(author.id, id)">{{ author.name }}</p>
            <UserTooltip :user class="-top-24"  v-if="user.photoId == id"/>
            <p>{{ posted_since }}</p>
        </div>
    </div>
</template>
