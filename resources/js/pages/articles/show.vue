<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, router, useForm, } from '@inertiajs/vue3';
import { computed } from 'vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Articles',
        href: '/articles',
    },
];

const article = computed(() => usePage().props?.article || {})

const form = useForm({});

const handleEditArticle = () => {
    if(confirm('Are you sure, you want to delete this article?')) {
        form.post(route('articles.store'), {
        onFinish: () => {
            alert('Article deleted Successfully!!!')
            router.visit('/articles ')
        } 
    });
    }
}

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex justify-end px-4">
                <Link :href="`/articles/${article?.id}/edit`" class="bg-blue-600 text-white rounded-lg px-4 py-2">
                    Edit
                </Link>

                <Link :href="`/articles/${article?.id}/edit`" class="bg-red-600 text-white rounded-lg px-4 py-2">
                    Delete
                </Link>
            </div>
            <div class="bg-transparent shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200 capitalize">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Title</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.title || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Author</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.author || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.category?.name || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">url</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 lowercase">{{ article?.url || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">source</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.source || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.description || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">content</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.content || '' }}</dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Image</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <img :src="article?.image" :alt="article?.title" />
                            </dd>
                        </div>
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Posted Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ article?.created_at || '' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
