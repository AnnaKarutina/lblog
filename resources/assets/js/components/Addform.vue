<template>
    <div>
        <h2>Add a new post</h2>
        <form @submit="onSubmit">
            <div class="form-group">
                <label for="postTitle">Title</label>
                <input v-model="post.title" type="text" class="form-control" id="postTitle" placeholder="Enter post title">
            </div>
            <div class="form-group">
                <ckeditor v-model="post.body"></ckeditor>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    import Ckeditor from 'vue-ckeditor2'

    export default {
        props: ['user_id'],
        components: { Ckeditor },
        data () {
            return {
                post: {
                    title: '',
                    body: '',
                    user_id: this.user_id
                }
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault()
                fetch('api/post', {
                    method: 'POST',
                    headers: {
                        "content-type": "application/json"
                    },
                    body: JSON.stringify(this.post)
                }).then(data => {
                    console.log('Request succeeded with response', data);
                    console.log(this.post)
                    window.location.href = '/';
                })
                .catch(error => {
                    console.log('Request failed', error);
                });
            }       
        }
    }
</script>

