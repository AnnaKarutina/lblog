<template>
    <div class="container">
            <div v-if="!edit">
                <div class="row">
                    <h2 class="mr-4 mt-4" aria-describedby="postDate">{{ post.title }}</h2>
                    <div v-if="this.user == this.post.user" class="btn-group mt-4" role="group">
                        <button class="btn button btn-sm btn-warning" @click="editHandler"><i class="fas fa-edit"></i></button>
                        <button class="btn button btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <small class="postDate form-text text-muted mb-4">Created at: {{ post.created_at }} by {{ post.user }}</small>
                </div>
                <p class="text-justify" v-html="post.body"></p>
            </div>
            <div v-else>
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
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this post?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                        <div class="modal-body">
                            <p>If you delete this post, it cannot be recovered!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" @click="deleteHandler">Remove post</button>
                        </div>
                    </div>    
                </div> 
            </div>
    </div>
</template>

<script>
    export default {
        props: ['postid', 'user'],
        data() {
            return {
                edit: false,
                post: {
                    title: '',
                    body: '',
                    user: '',
                },
            }
        },
        created() {
            this.fetchPost(this.postid);
        },
        methods: {
            editHandler() {
                this.edit = true
            },
            onSubmit(evt) {
               evt.preventDefault()
                fetch('/api/post', {
                    method: 'PUT',
                    headers: {
                        "content-type": "application/json"
                    },
                    body: JSON.stringify({
                        post_id: this.postid,
                        title: this.post.title,
                        body: this.post.body
                    })
                }).then(data => {
                    console.log('Request succeeded with response', data);
                    window.location.href = '/post/' + this.postid;
                })
                .catch(error => {
                    console.log('Request failed', error);
                });
            },
            deleteHandler() {
                fetch('/api/post/' + this.postid, {
                    method: 'DELETE',
                }).then(function (data) {
                    console.log('Request succeeded with response', data);
                    window.location.href = '/';
                })
                .catch(function (error) {
                    console.log('Request failed', error);
                });
            },
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

<style scoped>
    .button {
        height: 30px !important
    }
</style>
