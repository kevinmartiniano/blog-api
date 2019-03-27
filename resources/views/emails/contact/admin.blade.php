<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
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
		O leitor {{ $contactName }} entrou em contato pelo formulário do site.
	</p>

	<hr />

	<p>
		Telefone para contato: {{ $contactPhoneNumber }}
	</p>
	<p>
		Email para contato: {{ $contactEmail }}
	</p>

	<hr />

	<p>
		Mensagem enviada:
	</p>

	<p>
		{{ $contactMessage }}
	</p>
</body>
</html>