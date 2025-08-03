<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router, useForm, } from '@inertiajs/vue3';
import { computed } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    },
];

const category = computed(() => usePage().props?.category || {})

const form = useForm({});

const handleDeleteCategory = () => {
    if(confirm('Are you sure, you want to delete this category?')) {
        form.delete(route('categories.delete', { category: category.value.id }), {
            onFinish: () => {
                alert('Category deleted Successfully!!!')
                router.visit('/categories')
            } 
        });
    }
}

</script>

<template>
    <Head title="Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex justify-end px-4 space-x-3">
                <Link :href="`/categories/${category?.id}/edit`" class="bg-blue-600 text-white rounded-lg px-4 py-2">
                    Edit
                </Link>

                <a @click="handleDeleteCategory" href="#" class="bg-red-600 text-white rounded-lg px-4 py-2">
                    Delete
                </a>
            </div>
            <div class="bg-transparent shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200 capitalize">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ category?.name || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Slug</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ category?.slug || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ category?.description || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Posted Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ category?.created_at || '' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
