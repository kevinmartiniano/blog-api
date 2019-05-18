<template>
	<div>
		<p>
			<h3>
				Comments
			</h3>
		</p>

		<hr />

		<form v-on:submit.prevent="sendComment" v-if="user_id != ''">
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
				Posted by <span class="subheading" :id="'comment_' +  comment.id" v-bind="setUsername(comment.id, comment.created_id)">{{ comment.created_by }}</span> on {{ comment.created_at }}
			</p>
		</div>
		<hr />
	</div>
</template>

<script>
export default {
	data() {
		return {
			formComment: {
				content: '',
				created_id: '',
				parent_id: '',
			},
			accessToken: '',
			accessTokenId: '',
			clientId: '',
			clientName: '',
			tokens: [],
		};
	},

	props: [
		'comments',
		'user_id',
		'post_id',
	],

	ready() {
		this.setParentId();
		this.setCreatedId();
	},

	mounted() {
		this.setParentId();
		this.setCreatedId();
	},

	methods: {
		getComment() {
			return this.formComment.comment;
		},

		getCreatedId() {
			return this.formComment.created_id;
		},

		getParentId() {
			return this.formComment.parent_id;
		},

		getUsername(o, args) {
			$('span[id="comment_' + args.id + '"]').text(o.data.name);
		},

		setParentId() {
			this.formComment.parent_id = parseInt(this.post_id);
		},

		// TODO: get real user
		setCreatedId() {
			this.formComment.created_id = parseInt(this.user_id);
		},

		setUsername: function(cid, uid) {
			this.requestApi('get', '/api/v1/users/' + uid, {}, 'getUsername', {
				id: cid,
			});
		},

		sendComment() {
			this.requestApi('post', '/api/v1/comments/', {
				content: this.getComment(),
				created_id: this.getCreatedId(),
				parent_id: this.getParentId(),
			}, 'refreshPage', {});
		},

		refreshPage(o, args) {
			location.reload();
		},

		requestApi(method, uri, form, exec, args) {
			this.getClients(method, uri, form, exec, args);
		},

		getClients(method, uri, form, exec, args) {
			axios.get('/oauth/clients').then(response => {
				if(response.data.length == 0) {
					this.createClient(method, uri, form, exec, args);
				} else {
					this.clientId = response.data[0].id;
					this.clientName = response.data[0].name;
					this.setNewToken(method, uri, form, exec, args);
				}
			}).catch(err => {
				if(err.response.status == 401) {
					window.location.href = window.location.origin;
				} else {
					console.error(e);
				}
			});
		},

		createClient(method, uri, form, exec, args) {
			axios.post('/oauth/clients', {
				name: 'user ' + this.user_id,
				redirect: window.location.origin
			}).then(response => {
				this.getClients(method, uri, form, exec, args);
			}).catch (error => {
				console.error(error);
			});
		},

		/*
		* Creating new personal access token for the user.
		*/
		setNewToken(method, uri, form, exec, args) {
			axios.post('/oauth/personal-access-tokens', {
				name: this.clientName,
				scopes: []
			}).then(response => {
				this.accessToken = response.data.accessToken;
				this.accessTokenId = response.data.token.id;

				this.sendRequest(method, uri, form, exec, args);
			}).catch(error => {
				console.error(error);
			});
		},

		sendRequest(method, uri, form, exec, args) {
			if(method == 'get' || method == 'delete') {
				axios[method](uri, {
					headers: {
						'Authorization': "Bearer " + this.accessToken,
						'Content-Type': "application/json",
						'Accept': "application/json",
					}
				}).then(resp => {
					this.revoke();
					this[exec](resp, args);
				}).catch(e => {
					console.error(e);
				});
			} else {
				axios[method](uri, form, {
					headers: {
						'Authorization': "Bearer " + this.accessToken,
						'Content-Type': "application/json",
						'Accept': "application/json",
					}
				}).then(resp => {
					this.revoke();
					this[exec](resp, args);
				}).catch(e => {
					console.error(e);
				});
			}
		},

		/*
		* Deleting last created token.
		*/
		revoke() {
			axios.delete('/oauth/personal-access-tokens/' + this.accessTokenId).then(resp => {
				this.accessTokenId = '';
				this.accessToken = '';
				this.clientId = '';
				this.clientname = '';
			});
		},
	},
}
</script>