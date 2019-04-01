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
				formComment: [],
			};
		},

		props: [
			'comments'
		],

		ready() {
			this.getComments();
		},

		mounted() {
			this.getComments();
		},

		methods: {
			getComments() {
				console.log(this.comments);
			},

			sendComment() {
				console.log(this.formComment);
			},
		},
	}
</script>