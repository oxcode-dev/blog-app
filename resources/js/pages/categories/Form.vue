<script setup lang="js">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { computed } from 'vue';



const breadcrumbs = [
    {
        title: 'Articles',
        href: '/articles',
    },
];

const article = computed(() => usePage().props?.article || {})
const categories = computed(() => usePage().props?.categories || [])

const form = useForm({
    title: article.value?.title || '',
    content: article.value?.content || '',
    description: article.value?.description || '',
    author: article.value?.author || '',
    category_id: article.value?.category_id || '',
    image: article.value?.image || '',
    source: article.value?.source || '',
    url: article.value?.url || '',
    id: article.value?.id || null,
});

const submit = () => {
    form.post(route('articles.store'), {
        onFinish: () => {
            alert('Article Saved Successfully!!!')
            router.visit('/articles ')
        } 
    });
};

</script>

<template>
    <Head title="Articles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="bg-white shadow-sm overflow-hidden sm:rounded-lg my-4">
                <div class="px-4 py-5 w-full md:max-w-lg">
                    <form @submit.prevent="submit" class="space-y-2">
                        <!-- <pre>{{ article }}</pre> -->
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
                            <Label for="category_id">Category</Label>
                            <select
                                id="category_id"
                                type="text"
                                required
                                v-model="form.category_id"
                                placeholder="Category..."
                                class="block w-full pl-2 pr-10 py-2 text-base border border-gray-300 focus:outline-hidden sm:text-sm rounded-md capitalize"
                            >
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <InputError :message="form?.errors?.category_id" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="author">Author</Label>
                            <Input
                                id="author"
                                type="text"
                                required
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
                                :tabindex="1"
                                autocomplete="url"
                                v-model="form.url"
                                placeholder="https://www.johndoe.com"
                            />
                            <InputError :message="form?.errors?.url" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="source">Source</Label>
                            <Input
                                id="source"
                                type="text"
                                required
                                :tabindex="1"
                                v-model="form.source"
                                placeholder="source..."
                            />
                            <InputError :message="form?.errors?.source" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="description">Description</Label>
                            <textarea
                                id="description"
                                required
                                :tabindex="1"
                                v-model="form.description"
                                rows="6"
                                class="block w-full pl-2 pr-10 py-2 text-base border border-gray-300 focus:outline-hidden sm:text-sm rounded-md capitalize"
                                placeholder="Description..."
                            ></textarea>
                            <InputError :message="form?.errors?.description" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="content">Content</Label>
                            <textarea
                                id="content"
                                required
                                :tabindex="1"
                                v-model="form.content"
                                rows="6"
                                class="block w-full pl-2 pr-10 py-2 text-base border border-gray-300 focus:outline-hidden sm:text-sm rounded-md capitalize"
                                placeholder="Content..."
                            ></textarea>
                            <InputError :message="form?.errors?.content" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="image">Image URL</Label>
                            <Input
                                id="image"
                                type="url"
                                :tabindex="1"
                                v-model="form.image"
                                placeholder="https://www.johndoe.com/pix.png"
                            />
                            <InputError :message="form?.errors?.image" />
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
