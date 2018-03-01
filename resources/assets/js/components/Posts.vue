<template>
    <div>
        <h2>Posts</h2>
        <div class="card card-body mb-2" v-for="post in posts" v-bind:key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
        </div>
    </div>
</template>

<script>
    export default {
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
