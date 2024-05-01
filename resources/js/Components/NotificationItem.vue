<script setup>
import snarkdown from 'snarkdown';


const {title} = defineProps(['title', 'timeAgo'])

const formatted_title = snarkdown(title);
console.log(formatted_title);
</script>
<template>
    <div class="space-y-2 hover:bg-slate-100 py-3 px-5">
        <div v-html="formatted_title"></div>
        <span class="text-slate-400">{{ timeAgo }}</span>
    </div>
</template>