<template>
	<div>
		<div class="row">
			<div class="col-md-10">
				<h1>
					List Users
				</h1>
			</div>
			<div class="col-md-2">
				<a class="btn btn-primary float-lg-right" href="#" role="button" data-toggle="modal" data-target="#createUserModal">Create</a>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="createUserTitle">Create new user</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" class="form-control" v-model="create.name" id="name" aria-describedby="nameHelp" placeholder="Enter name">
									<small id="nameHelp" class="form-text text-muted">Tipe your name.</small>
								</div>
								<div class="form-group">
									<label for="email">Email address</label>
									<input type="email" class="form-control" v-model="create.email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
									<small id="emailHelp" class="form-text text-muted">Tipe your email address.</small>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" v-model="create.password" id="password" placeholder="Password">
								</div>
								<div class="form-group">
									<label for="confirmPassword">Confirm Password</label>
									<input type="password" class="form-control" v-model="create.confirmPassword" id="confirmPassword" placeholder="Confirm Password">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearCreateForm()">Cancel</button>
							<button type="button" class="btn btn-primary" v-on:click="createUser()">Create</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
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
							<td><span :id="'type_' + user.id"></span></td>
							<td>
								<a href="#" v-on:click="showDetails(user.id)">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fa fa-file fa-stack-1x fa-inverse"></i>
									</span>
								</a>

								<a href="#" data-toggle="modal" :data-target="'#editUserModal-' + user.id">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fa fa-edit fa-stack-1x fa-inverse"></i>
									</span>
								</a>

								<a href="#" data-toggle="modal" :data-target="'#delConfirm-' + user.id">
									<span class="fa-stack fa-md">
										<i class="fas fa-square fa-stack-2x"></i>
										<i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
									</span>
								</a>

								<!-- Modal -->
								<div class="modal fade" :id="'editUserModal-' + user.id" tabindex="-1" role="dialog" aria-labelledby="editUserTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editUserTitle">Edit user</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form>
													<div class="form-group">
														<label :for="'name-' + user.id">Name</label>
														<input type="text" class="form-control" :id="'name-' + user.id" aria-describedby="nameHelp" placeholder="Enter name" v-bind:value="user.name">
														<small id="nameHelp" class="form-text text-muted">Tipe your name.</small>
													</div>
													<div class="form-group">
														<label :for="'email-' + user.id">Email address</label>
														<input type="email" class="form-control" :id="'email-' + user.id" aria-describedby="emailHelp" placeholder="Enter email" v-bind:value="user.email">
														<small id="emailHelp" class="form-text text-muted">Tipe your email address.</small>
													</div>
													<div class="form-group">
														<label :for="'password-' + user.id">Password</label>
														<input type="password" class="form-control" :id="'password-' + user.id" placeholder="Password">
													</div>
													<div class="form-group">
														<label :for="'confirmPassword-' + user.id">Confirm Password</label>
														<input type="password" class="form-control" :id="'confirmPassword-' + user.id" placeholder="Confirm Password">
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-primary" v-on:click="editUser(user.id)">Submit</button>
											</div>
										</div>
									</div>
								</div>

								<!-- Modal -->
								<div class="modal fade" :id="'delConfirm-' + user.id" tabindex="-1" role="dialog" aria-labelledby="delConfirmLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="'delConfirmLabel">Delete User</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Are you sure you want to delete this user?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												<button type="button" class="btn btn-primary" v-on:click="delUser(user.id)">Confirm</button>
											</div>
										</div>
									</div>
								</div>
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
			create: {},
			edit: [],
		};
	},

	props: [
		'users',
		'user_id',
	],

	ready() {
		this.getUserType();
	},

	mounted() {
		this.getUserType();
	},

	methods: {
		showDetails(uid) {
			window.location.href = window.location.origin + '/users/' + uid;
		},

		getUserType() {
			this.requestApi('get','/api/v1/user-types/', {}, 'setUserType', {});
		},

		setUserType(o) {
			for(var i = 0; i < this.users.length; i++) {
				$('span[id="type_' + this.users[i].id + '"]').text(r => {
					for(var n = 0; n < o.data.length; n++) {
						if(o.data[n].id == this.users[i].user_type_id) {
							return o.data[n].name;
						}
					}
				});
			}
		},
		
		createUser() {
			if(this.create.password == this.create.confirmPassword) {
				this.requestApi('post', '/api/v1/users/', {
					name: this.create.name,
					email: this.create.email,
					password: this.create.password,
				}, 'refreshPage', {});
			} else {
				console.log('Incorrect confirm password, please verify!');
			}
		},

		clearCreateForm() {
			$('input[id="name"]').val("");
			$('input[id="email"]').val("");
			$('input[id="password"]').val("");
			$('input[id="confirmPassword"]').val("");
		},

		editUser(uid) {
			if($('#password-' + uid).val() == $('#confirmPassword-' + uid).val() && $('#password-' + uid).val() != '') {
				var edit = {
					name: $('#name-' + uid).val(),
					email: $('#email-' + uid).val(),
					password: $('#password-' + uid).val(),
				};

				this.requestApi('put', '/api/v1/users/' + uid, edit, 'refreshPage', {});
			} else {
				if($('#password-' + uid).val() == '') {
					var edit = {
						name: $('#name-' + uid).val(),
						email: $('#email-' + uid).val(),
					};

					this.requestApi('put', '/api/v1/users/' + uid, edit, 'refreshPage', {});
				} else {
					alert('Wrong password!');
				}
			}
		},

		delUser(uid) {
			this.requestApi('delete', '/api/v1/users/' + uid, {}, 'refreshPage', {});
		},

		refreshPage(o, args) {
			window.location.href = window.location.origin + '/users/';
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