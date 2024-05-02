<script setup>
import { ref } from 'vue';
import { vOnClickOutside } from '@vueuse/components';
import UserTooltip from './UserTooltip.vue';

const p = defineProps(['photo']);

console.log(p);

const isTooltipVisible = ref(false);

const closeUserTooltip = () => isTooltipVisible.value = false;

</script>

<template>
    <div class="p-5 rounded bg-white w-1/2 mx-auto">
        <h2 class="text-2xl font-bold mb-1">{{ photo.title }}</h2>
        <div class="flex relative space-x-2">
            <p class="underline cursor-pointer" @click="isTooltipVisible=true">{{ photo.user.name }}</p>
            <UserTooltip :user-id="photo.user.id" class="-top-24" v-if="isTooltipVisible" v-on-click-outside="closeUserTooltip"/>
            <span class="text-slate-400">|</span>
            <p>{{ photo.posted_ago }}</p>
        </div>

        <div class="mt-8 aspect-square rounded bg-cover" :style="{backgroundImage: 'url(' + photo.path + ')'}">
            <!-- <img :src="path" alt="" srcset="" class="rounded block max-h-full max-w-full"> -->
        </div>
        <!-- Not implemented yet -->
        <!-- <ul class="flex items-center space-x-2 mb-4" v-if="tags">
            <li class="px-2 rounded bg-blue-100" v-for="tag in tags" :key="tag">{{ tag }}</li>
        </ul> -->
        
    </div>
</template>
