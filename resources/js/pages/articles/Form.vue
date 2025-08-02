<script setup lang="js">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import { computed } from 'vue';


const breadcrumbs = [
    {
        title: 'Articles',
        href: '/articles',
    },
];

const article = computed(() => usePage().props?.article || {})

const form = useForm({
    title: '',
});

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="px-4 py-5 w-full md:max-w-lg">
                    <form class="space-y-2">
                        <pre>{{ article }}</pre>
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="title"
                                v-model="form.title"
                                placeholder="Article Title..."
                            />
                            <InputError :message="form?.errors?.author" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="author">Author</Label>
                            <Input
                                id="author"
                                type="text"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="author"
                                v-model="form.author"
                                placeholder="Article Author..."
                            />
                            <InputError :message="form?.errors?.author" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="url">URL</Label>
                            <Input
                                id="url"
                                type="url"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="url"
                                v-model="form.url"
                                placeholder="https://www.johndoe.com"
                            />
                            <InputError :message="form?.errors?.url" />
                        </div>
                        <div>
                            <Button type="submit" class="mt-4" :tabindex="4" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Submit
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
