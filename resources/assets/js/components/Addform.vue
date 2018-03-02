<template>
    <div>
        <h2>Add a new post</h2>
        <form @submit="onSubmit">
            <div class="form-group">
                <label for="postTitle">Title</label>
                <input v-model="post.title" type="text" class="form-control" id="postTitle" placeholder="Enter post title">
            </div>
            <div class="form-group">
                <label for="postBody">Body</label>
                <textarea v-model="post.body" class="form-control" id="postBody" placeholder="Enter post body" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                post: {
                    title: '',
                    body: ''
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
                    window.location.href = '/';
                })
                .catch(error => {
                    console.log('Request failed', error);
                });
            }       
        }
    }
</script>

