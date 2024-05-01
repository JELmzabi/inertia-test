<script setup>

defineProps(['title', 'timeAgo'])

</script>
<template>
    <div class="space-y-2 hover:bg-slate-100 py-3 px-5">
        <p>{{ title }}</p>
        <span class="text-slate-400">{{ timeAgo }}</span>
    </div>
</template>