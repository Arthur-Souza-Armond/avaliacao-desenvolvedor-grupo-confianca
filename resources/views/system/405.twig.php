{% extends 'partials/document.twig.php' %}

{% block body %}
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-12">
                <img class="w-100" src="imgs/404.png">
            </div>
            <div class="col-md-6 col-12">
                <h1 class="fw-bolder">
                    405
                </h1>
                <h2>
                    Método de acesso não suportado
                </h2>
                <p class="my-4">
                    Parece que você tentou acessar um caminho com um método não suportado em nosso site. Que tal voltar para página principal e aproveitar todos os nossos benefícios?
                </p>
                <div>
                    <a class="bg-success rounded border-0 px-5 py-2 text-light fw-bolder text-decoration-none" href="{{ home }}">
                        Home
                    </a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}