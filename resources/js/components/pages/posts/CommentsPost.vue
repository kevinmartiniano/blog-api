<template>
	<div>
		<p>
			<h3>
				Comments
			</h3>
		</p>

		<hr />

		<form v-on:submit.prevent="sendComment">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Comment</label>
					<textarea v-model="formComment.comment" rows="5" class="form-control" placeholder="Comment" id="comment" name="comment" required data-validation-required-message="Please enter a comment."></textarea>
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<br>
			<div id="success"></div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" id="sendCommentBtn" value="Send" />
			</div>
		</form>

		<hr />

		<div class="post-preview"
		 v-for="comment of comments"
		 v-bind:key="comment.id">
			<h5>
				{{ comment.content }}
			</h5>
			<p class="post-meta">
				Posted by <span class="subheading">{{ comment.created_by.name }}</span> on {{ comment.created_at }}
			</p>
		</div>
		<hr />
	</div>
</template>

<script>
	export default {
		data() {
			return {
				formComment: [{
					content: '',
					created_id: '',
					parent_id: '',
				},],
			};
		},

		props: [
			'comments'
		],

		ready() {
			//
		},

		mounted() {
			//
		},

		methods: {
			sendComment() {
				this.setParentId();
				this.setCreatedId();

				axios.post('/api/v1/comments/', {
					content: this.formComment.comment,
					created_id: this.formComment.created_id,
					parent_id: this.formComment.parent_id
				}).then(function(resp) {
					console.log(resp);
				}).catch(function(e) {
					console.log(e);
				});
			},

			setParentId() {
				this.formComment.parent_id = parseInt(window.location.pathname.split('/')[2]);
			},

			// TODO: get real user
			setCreatedId() {
				this.formComment.created_id = 1;
			},
		},
	}
</script>