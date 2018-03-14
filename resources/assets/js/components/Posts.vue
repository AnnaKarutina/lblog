<template>
    <div class="row">
        <div class="col-8">
            <h2>Posts</h2>
            <div class="card card-body mb-2" v-for="post in posts" v-bind:key="post.id">
                <div aria-describedby="postDate">
                    <h3 class="mb-4">{{ post.title }}
                        <span class="badge bg-success">{{ post.tag }}</span>
                    </h3>
                </div>
                    <a :href="/post/ + post.id">
                    <button type="button" class="mt-4 mb-4 btn btn-primary btn-sm button">Read more</button>
                </a>
                <small class="postDate form-text text-muted">Created at: {{ post.created_at }} by {{ post.user }}</small>
            </div>
        </div>
        <div class="col-4">
            <h2>Tags</h2>
            <ul class="list-group" v-for="tag in tags" v-bind:key="tag.id">
                <li class="list-group-item"><a :href="/tags/ + tag.id">{{ tag.title }}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                posts: [],
                tags: [],
            }
        },
        created() {
            this.fetchPosts();
            this.fetchTags();
        },
        methods: {
            fetchPosts() {
                fetch('api/posts')
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data
                })
            },
            fetchTags() {
                fetch('api/tags')
                .then(res => res.json())
                .then(res => {
                    this.tags = res.data
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

