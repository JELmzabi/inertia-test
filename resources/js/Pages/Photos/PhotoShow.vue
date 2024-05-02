<script setup>
import PhotoDetails from '@/Components/PhotoDetails.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

const {photo} = usePage().props;
</script>
<template>
    <Head title="Photo Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Photo Details</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <PhotoDetails :photo />
        </div>
    </AuthenticatedLayout>
</template>