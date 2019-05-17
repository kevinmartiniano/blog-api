<template>
	<div>
		<div class="row">
			<div class="col-md-10">
				<h1>
					List Posts
				</h1>
			</div>
			<div class="col-md-2">
				<a class="btn btn-primary float-lg-right" href="#" role="button">Create</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Title</th>
						<th scope="col">Author</th>
						<th scope="col">Created At</th>
						<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="post in posts.data" :key="post.id">
							<th scope="row">{{ post.id }}</th>
							<td>{{ post.title }}</td>
							<td><span :id="'created-' + post.id">{{ post.created_id }}</span></td>
							<td>{{ post.created_at }}</td>
							<td>
								<a href="#" v-on:click="postView(post.id)">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fa fa-file fa-stack-1x fa-inverse"></i>
									</span>
								</a>

								<a href="#">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fa fa-edit fa-stack-1x fa-inverse"></i>
									</span>
								</a>

								<a href="#">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
									</span>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			accessToken: '',
			accessTokenId: '',
			clientId: '',
			clientName: '',
			tokens: [],
		};
	},

	props: [
		'posts',
		'user_id'
	],

	ready() {
		this.getUserNames();
	},

	mounted() {
		this.getUserNames();
	},

	methods: {
		postView(pid) {
			window.location.href = window.location.origin + '/posts/' + pid;
		},

		getUserNames() {
			this.requestApi('get', '/api/v1/users/', {}, 'setUsers', {});
		},

		setUsers(o, args) {
			for(var i = 0; i < this.posts.data.length; i++) {
				for(var n = 0; n < o.data.length; n++) {
					if(o.data[n].id == this.posts.data[i].created_id) {
						$('span[id=created-' + this.posts.data[i].id + ']').text(o.data[n].name);
					}
				}
			}
		},

		refreshPage(o, args) {
			window.location.href = window.location.origin + '/posts/';
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