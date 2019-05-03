<template>
	<div>
		<div>
			<p>
				<h1>
					Create a new Post!
				</h1>
			</p>
			<p>
				Form to create a new post.
			</p>
		</div>
		<form v-on:submit.prevent="createPost">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Title</label>
					<input type="text" placeholder="Title" v-model="post.title" id="title" name="title" required="required" data-validation-required-message="Please enter a title." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Subtitle</label>
					<input type="text" placeholder="Subtitle" v-model="post.subtitle" id="subtitle" name="subtitle" required="required" data-validation-required-message="Please enter a subtitle." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Content</label>
					<textarea rows="5" placeholder="Content" v-model="post.content" id="content" name="content" required="required" data-validation-required-message="Please enter a content." class="form-control"></textarea>
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="success"></div>
			<div class="form-group">
				<button class="btn btn-primary" id="createPost">Send</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	data() {
		return {
			post: [],
		};
	},

	props: [
		'user_id',
	],

	ready() {
		//
	},

	mounted() {
		//
	},

	methods: {
		createPost() {
			var post = this.post;
			post.created_id = this.user_id;

			if(post.created_id != '') {
				axios.post('/api/v1/posts/', {
					title: post.title,
					subtitle: post.subtitle,
					content: post.content,
					created_id: post.created_id
				}).then(response => {
					window.location.href = window.location.origin + '/posts/' + response.data.id;
				}).catch(error => {
					console.debug(error);
				});
			} else {
				alert('You are unlogged in this site.');
			}
		},
	},
}
</script>