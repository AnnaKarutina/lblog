<template>
    <div>
        <h2>Posts</h2>
        <div class="card card-body mb-2" v-for="post in posts" v-bind:key="post.id">
            <div aria-describedby="postDate">
                <h3 class="mb-4">{{ post.title }}</h3>
            </div>
                <a :href="/post/ + post.id">
                <button type="button" class="mt-4 mb-4 btn btn-primary btn-sm button">Read more</button>
            </a>
            <small class="postDate form-text text-muted">Created at: {{ post.created_at }} by {{ post.user }}</small>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                posts: [],
            }
        },
        created() {
            this.fetchPosts();
        },
        methods: {
            fetchPosts() {
                fetch('api/posts')
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data
                })
            }
        }
    }
</script>

<style scoped>
    button {
        width: 80px;
    }
</style>

