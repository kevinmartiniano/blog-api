<template>
	<div>
		<table class="table table-hover">
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">User Type</th>
				<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" :key="user.id">
					<th scope="row">{{ user.id }}</th>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td><span :id="'type_' + user.id">{{ getUserType(user.id, user.user_type_id) }}</span></td>
					<td>
						<a v-bind:href="'/admin/users/' + user.id">
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
</template>

<script>
export default {
	data() {
		return {
			accessToken: '',
			accessTokenId: '',
			clients: [],
		};
	},

	props: [
		'users',
		'user_id',
	],

	ready() {
		//
	},

	mounted() {
		//
	},

	methods: {
		getUserType: function(uid, tid) {
			this.userType = this.requestApi('get', '/api/v1/user-types/' + tid, {}, 'setUserType', {
				id: uid,
			});
		},

		setUserType(user, o) {
			document.getElementById('type_' + user.id).textContent = o.data.name;
		},

		requestApi(method, uri, form, exec, args) {
			this.getClients(method, uri, form, exec, args);
		},

		getClients(method, uri, form, exec, args) {
			axios.get('/oauth/clients').then(response => {
				this.clients = response.data;

				if(this.clients.length == 0) {
					this.createClient(method, uri, form, exec, args);
				} else {
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
				name: this.clients[this.clients.length - 1].name,
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
					this[exec](args, resp);
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
					this[exec](args, resp);
				}).catch(e => {
					console.error(e);
				});
			}
		},

		/*
		 * Deleting last created token.
		 */
		revoke() {
			axios.delete('/oauth/personal-access-tokens/' + this.accessTokenId);
		},
	},
}
</script>