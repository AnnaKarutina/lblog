<template>
    <div>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Date</th>
            </tr>
            <tr v-for="post in posts" v-bind:key="post.id" v-if="userCompare(post.user)"> 
                <td><a :href="/post/ + post.id">{{ post.title }}</a></td>
                <td>{{ post.created_at }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['postid', 'user'],
        data() {
            return {
                posts: []
            }
        },
        created() {
            this.fetchPosts();
        },
        methods: {
            fetchPosts() {
                fetch('/api/posts')
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data
                })
            },
            userCompare (user) {
                return this.user == user;
            }
        }
    }
</script>
