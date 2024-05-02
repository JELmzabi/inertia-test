<script setup>
import { Link } from '@inertiajs/vue3';
import snarkdown from 'snarkdown';
import { computed } from 'vue';


const {title, action} = defineProps(['title', 'timeAgo', "action"])
const formatted_title = snarkdown(title);
const comp = computed(() => action?.route ? Link : 'div');
const props = computed(() => comp.value == Link ? {href: route(action.route, action.parameters)}: null);

</script>
<template>
    <component :is="comp" v-bind="props"  class="space-y-2 hover:bg-slate-100 py-3 px-5 block">
        <div v-html="formatted_title"></div>
        <span class="text-slate-400">{{ timeAgo }}</span>
    </component>
</template>