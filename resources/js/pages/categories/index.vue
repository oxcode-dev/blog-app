<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Pager from '@/components/Pager.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    },
];

const categories = computed(() => usePage().props?.categories || {})
const categoriesData = computed(() => usePage().props?.categories?.data || [])

</script>

<template>
    <Head title="Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="flex justify-end px-4">
                <Link :href="`/categories/create`" class="bg-blue-600 text-white rounded-lg px-4 py-2">
                    Create
                </Link>
            </div>
            <div class="relative min-h-[100vh] rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                
                <div>
                    <table class="min-w-full bg-transparent">
                        <thead>
                            <tr class="bg-gray-500 text-white border-b">
                                <th class="py-3 px-4 text-left">Name</th>
                                <th class="py-3 px-4 text-left">Slug</th>
                                <th class="py-3 px-4 text-left">Articles</th>
                                <!-- <th class="py-3 px-4 text-left">Total</th> -->
                                <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr v-for="(category, key) in categoriesData" :key="key" class="border-b border-blue-gray-200 capitalize">
                                <td class="py-3 px-4">{{ category?.name || '' }}</td>
                                <td class="py-3 px-4 capitalize">{{ category?.slug || '' }}</td>
                                <td class="py-3 px-4">{{ category?.articles .length || 0 }}</td>
                                <!-- <td class="py-3 px-4">$5025.00</td> -->
                                <td class="py-3 px-4">
                                    <Link :href="`/categories/${category.id}`" class="font-medium text-blue-600 hover:text-blue-800">
                                        View
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="py-6">
                    <Pager :item="categories" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
