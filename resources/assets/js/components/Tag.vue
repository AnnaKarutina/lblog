<template>
    <div>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Date</th>
            </tr>
            <tr v-for="post in posts" v-bind:key="post.id" v-if="idCompare(post.tag_id)"> 
                <td><a :href="/post/ + post.id">{{ post.title }}</a></td>
                <td>{{ post.created_at }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                posts: [],
                tag: ''
            }
        },
        created() {
            this.fetchPosts();
            this.fetchTag(this.id)
        },
        methods: {
            fetchPosts() {
                fetch('/api/posts')
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data
                })
            },
            fetchTag(id) {
                fetch('/api/tag/' + id)
                .then(res => res.json())
                .then(res => {
                    this.tag = res.data.id
                })
            },
            idCompare(id) {
                return this.tag == id
            }
        }
    }
</script>
