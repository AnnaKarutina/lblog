<template>
    <div class="container">
        <div class="row">
            <h2 class="mr-4" aria-describedby="postDate">{{ post.title }}</h2>
            <div class="btn-group mt-2" role="group">
                <button class="btn button btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                <button class="btn button btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-minus"></i></button>
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
        <small class="postDate form-text text-muted mb-4">Created at: {{ post.created_at }}</small>
        <p class="text-justify">{{ post.body }}</p>
        
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
