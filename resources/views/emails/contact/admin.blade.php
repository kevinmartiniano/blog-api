<p>
	<h1>
		Blog API
	</h1>
</p>
<p>
	<h5>
		Mail sended in contact form
	</h5>
</p>

<hr />

<p>
	O leitor {{ $contact->name }} entrou em contato pelo formulário do site.
</p>

<hr />

<p>
	Telefone para contato: {{ $contact->phone_number }}
</p>
<p>
	Email para contato: {{ $contact->email }}
</p>

<hr />

<p>
	Mensagem enviada:
</p>

<p>
	{{ $contact->message }}
</p>