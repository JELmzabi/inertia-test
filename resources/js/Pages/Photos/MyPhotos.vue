<script setup>
import PhotoItem from '@/Components/PhotoItem.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({ photos: Array })

</script>

<template>
    <Head title="My Photo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Photo</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" grid grid-cols-3 gap-8">
                <template v-if="photos">
                  <PhotoItem v-for="photo in photos" :path="photo.path" :author="$page.props.auth.user.name" :title="photo.title" :posted_since="photo.posted_ago" />
                </template>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
