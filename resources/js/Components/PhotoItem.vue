<script setup>
defineProps(['imgSrc', 'title', 'tags', 'author', 'posted_since'])
</script>

<template>
    <div class="p-5 rounded bg-white">
        <div class="mb-6">
            <img src="{{ imgSrc }}" alt="" srcset="" class="rounded">
        </div>
        <h3 class="text-lg font-bold mb-1">{{ title }}</h3>
        <!-- Not implemented yet -->
        <!-- <ul class="flex items-center space-x-2 mb-4" v-if="tags">
            <li class="px-2 rounded bg-blue-100" v-for="tag in tags" :key="tag">{{ tag }}</li>
        </ul> -->
        <div class="flex justify-between">
            <p class="underline">{{ author }}</p>
            <p>{{ posted_since }}</p>
        </div>
    </div>
</template>
