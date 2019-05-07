<template>
	<div>
		<p>
			<h1>
				Edit user
			</h1>
		</p>
		<p>
			Form to edit user.
		</p>
		<form v-on:submit.prevent="editUser">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Name</label>
					<input type="text" placeholder="Name" v-model="user.name" id="name" name="name" required="required" data-validation-required-message="Please enter a name." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label>Email</label>
					<input type="text" placeholder="Email" v-model="user.email" id="email" name="email" required="required" data-validation-required-message="Please enter a email." class="form-control">
					<p class="help-block text-danger"></p>
				</div>
			</div>
			<div class="success"></div>
			<div class="form-group">
				<button class="btn btn-primary" id="editUserButton">Send</button>
			</div>
		</form>
	</div>
</template>

<script>
export default {
	data() {
		return {
			user: [],
			header: [],
			tokens: [],
			accessToken: '',
			accessTokenId: '',
		};
	},

	props: [
		'user_edit',
		'user_id',
	],

	ready() {
		this.prepareComponent();
	},

	mounted() {
		this.prepareComponent();
	},

	methods: {
		/**
		 * Prepare the component (Vue 2.x).
		 */
		prepareComponent() {
			this.setName();
			this.setEmail();
		},

		getClients() {
			axios.get('/oauth/clients').then(response => {
				this.clients = response.data;
			});
		},

		/**
		 * Get all of the authorized tokens for the user.
		 */
		getToken() {
			axios.get('/oauth/personal-access-tokens').then(response => {
				this.tokens = response.data[response.data.length - 1];

				this.setNewToken();
    		}).catch(error => {
				console.error(error);
			});
		},

		/*
		 * Creating new personal access token for the user.
		 */
		setNewToken() {
			axios.post('/oauth/personal-access-tokens', {
				name: this.tokens.name,
				scopes: []
			}).then(response => {
				this.accessToken = response.data.accessToken;
				this.accessTokenId = response.data.token.id;

				this.postForm();
			}).catch(error => {
				console.error(error);
			});
		},

		/*
		 * Sending informations to update user.
		 */
		postForm() {
			var user = this.user;

			axios.put('/api/v1/admin/users/' + this.user_edit.id, {
				name: user.name,
				email: user.email
			}, {
				headers: {
					'Authorization': "Bearer " + this.accessToken,
					'Content-Type': "application/json",
					'Accept': "application/json",
				}
			}).then(response => {
				this.revoke();
			}).catch(error => {
				console.debug(error);
			});
		},

		setName: function() {
			document.getElementById('name').value = this.user_edit.name;
		},

		setEmail: function() {
			document.getElementById('email').value = this.user_edit.email;
		},

		editUser() {
			this.getToken();
		},

		/*
		 * Deleting last created token.
		 */
		revoke() {
			axios.delete('/oauth/personal-access-tokens/' + this.accessTokenId).then(response => {
				window.location.href = window.location.origin + '/users/' + this.user_edit.id;
			}).catch(error => {
				console.error(error);
			});
		},
	},
}
</script>