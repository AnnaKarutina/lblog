<template>
    <div class="container">
        <h2 aria-describedby="postDate">{{ post.title }}</h2>
        <small class="postDate form-text text-muted mb-4">Created at: {{ post.created_at }}</small>
        <p>{{ post.body }}</p>
    </div>
</template>

<script>
    export default {
        props: ['postid'],
        data() {
            return {
                post: {
                    title: '',
                    body: '',
                    created_at: ''
                },
            }
        },
        created() {
            this.fetchPost(this.postid);
        },
        methods: {
            fetchPost(id) {
                fetch('/api/post/' + id)
                .then(res => res.json())
                .then(res => {
                    this.post = res.data
                })
            }
        }
    }
</script>

