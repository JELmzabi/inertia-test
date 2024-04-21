<script setup>
import { Link } from '@inertiajs/vue3';


const langs = [{code: 'en', label: 'en'},
                {code: 'fr', label: 'fr'},
                {code: 'ar', label: 'ar'}
            ];
</script>

<template>
    <div class="flex space-x-2">
        <template v-for="lang in langs" :key="lang.code">
            <Link :href="route('lang', lang.code)" class="uppercase text-gray-500" :class="{'text-gray-950': $page.props.localeData.languageCode == lang.code}">{{ lang.label }}</Link>
        </template>
    </div>
</template>
