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

const article = computed(() => usePage().props?.article || {})

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="relative min-h-[100vh] rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <pre>{{ article }}</pre>

            </div>
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <dl class="sm:divide-y sm:divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">First name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Mohamed</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
