<template>
	<div>
		<div class="row">
			<div class="col-md-10">
				<h1>
					Details User
				</h1>
			</div>
			<div class="col-md-2">
				<a class="btn btn-primary float-lg-right" href="#" role="button" data-toggle="modal" :data-target="'#editUserModal-' + user.id">Edit</a>
			</div>

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
									<label for="txt_name">Name</label>
									<input type="text" class="form-control" v-model="updUser.txt_name" id="txt_name" aria-describedby="nameHelp" placeholder="Enter name">
									<small id="nameHelp" class="form-text text-muted">Tipe your name.</small>
								</div>
								<div class="form-group">
									<label for="txt_email">Email address</label>
									<input type="email" class="form-control" v-model="updUser.txt_email" id="txt_email" aria-describedby="emailHelp" placeholder="Enter email" >
									<small id="emailHelp" class="form-text text-muted">Tipe your email address.</small>
								</div>
								<div class="form-group">
									<label for="txt_password">Password</label>
									<input type="password" class="form-control" v-model="updUser.txt_password" id="txt_password" placeholder="Password">
								</div>
								<div class="form-group">
									<label for="txt_confirmPassword">Confirm Password</label>
									<input type="password" class="form-control" v-model="updUser.txt_confirmPassword" id="txt_confirmPassword" placeholder="Confirm Password">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary" v-on:click="editUser()">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Name</label>
						<input type="text" id="name" name="name" class="form-control" v-bind:value="user.name" readonly>
						<p class="help-block text-danger"></p>
					</div>
				</div>
				<div class="control-group">
					<div class="form-group floating-label-form-group controls">
						<label>Email</label>
						<input type="text" placeholder="Email" id="email" name="email" class="form-control" v-bind:value="user.email" readonly>
						<p class="help-block text-danger"></p>
					</div>
				</div>
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
			updUser: {},
		};
	},

	props: [
		'user',
	],

	ready() {
		//
	},

	mounted() {
		this.populateFields();
	},

	methods: {
		populateFields() {
			this.setUserName();
			this.setUserEmail();
		},

		setUserName() {
			$('input[id="txt_name"]').val(this.getUserName());
		},

		setUserEmail() {
			$('input[id="txt_email"]').val(this.getUserEmail());
		},

		getUserName() {
			return this.user.name;
		},

		getUserEmail() {
			return this.user.email;
		},

		editUser() {
			if(this.updUser.txt_password == this.updUser.txt_confirmPassword && this.updUser.txt_password != '') {
				this.requestApi('put', '/users/' + this.user.id, {
					name: this.updUser.txt_name,
					email: this.updUser.txt_email,
					password: this.updUser.txt_password,
				}, 'refreshPage', {});
			} else {
				if(this.updUser.txt_password == '') {
					this.requestApi('put', '/users/' + this.user.id, {
						name: this.updUser.txt_name,
						email: this.updUser.txt_email,
					}, 'refreshPage', {});
				} else {
					alert('Wrong password!');
				}
			}
		},

		refreshPage(o, args) {
			window.location.href = window.location.origin + '/users/' + this.user.id;
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