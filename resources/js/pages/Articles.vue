<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Pager from '@/components/Pager.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Articles',
        href: '/articles',
    },
];

const articles = computed(() => usePage().props?.articles || {})
const articlesData = computed(() => usePage().props?.articles?.data || [])

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="relative min-h-[100vh] rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <!-- <pre>{{ articles }}</pre> -->

                <div>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-500 text-white border-b">
                                <th class="py-3 px-4 text-left">Title</th>
                                <th class="py-3 px-4 text-left">Category</th>
                                <th class="py-3 px-4 text-left">Comment</th>
                                <!-- <th class="py-3 px-4 text-left">Total</th> -->
                                <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr v-for="(article, key) in articlesData" :key="key" class="border-b border-blue-gray-200">
                                <td class="py-3 px-4">{{ article?.title || '' }}</td>
                                <td class="py-3 px-4 capitalize">{{ article?.category?.name || '' }}</td>
                                <td class="py-3 px-4">{{ article?.comments.length || 0 }}</td>
                                <!-- <td class="py-3 px-4">$5025.00</td> -->
                                <td class="py-3 px-4">
                                    <Link :href="`/articles/${article.id}`" class="font-medium text-blue-600 hover:text-blue-800">
                                        View
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="py-6">
                    <Pager :item="articles" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
