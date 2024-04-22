<script setup>
import PhotoItem from '@/Components/PhotoItem.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import UserTooltip from '@/Components/UserTooltip.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

defineProps({ errors: Object, photos: Array })

const userId = ref(null);
const isUploadModalOpen = ref(false);
const form = useForm({
                  photo: null,
                  title: null,
                  public: true
                });

const openUploadModal = () => {
    isUploadModalOpen.value = true;
};

const closeUploadModal = () => {
    isUploadModalOpen.value = false;
};

</script>

<template>
    <Head title="Photo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Photo</h2>
        </template>

        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 flex justify-end">
                <PrimaryButton @click="openUploadModal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    Add Photo
                </PrimaryButton>
            </div>
            <div class=" grid grid-cols-3 gap-8">
                <template v-if="photos">
                  <PhotoItem v-for="photo in photos" :path="photo.path" :author="photo.user" :title="photo.title" :posted_since="photo.posted_ago" />
                </template>
            </div>

            <!-- <UserTooltip /> -->
        </div>

        <Modal :show="isUploadModalOpen" @close="closeUploadModal">
            <div class="p-6">
                <form @submit.prevent="form.post('/photos')">
                  <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                      <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

                      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                          <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10" :class="{'border-red-300': errors.photo}">
                            <div class="text-center">
                              <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                              </svg>
                              <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="photo" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                  <span>Upload a file</span>
                                  <input id="photo" name="photo" type="file" @input="form.photo = $event.target.files[0]" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                              </div>
                              <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p v-if="errors.photo" class="text-red-500 mt-2 sm:text-sm sm:leading-6">{{ errors.photo }}</p>
                    </div>

                    <div class="">
                        <div class="sm:col-span-8">
                          <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                          <div class="mt-2">
                            <input type="text" name="title" id="title" v-model="form.title" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" :class="{'ring-red-300': errors.title}">
                            <p v-if="errors.title" class="text-red-500 mt-2 sm:text-sm sm:leading-6">{{ errors.title }}</p>
                          </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                      <label class="inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" v-model="form.public" class="sr-only peer">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Share with all</span>
                      </label>
                    </div>
                  </div>

                  <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900" @click="closeUploadModal">Cancel</button>
                    <PrimaryButton type="submit">Save</PrimaryButton>
                  </div>
                </form>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
