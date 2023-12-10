{% extends 'partials/document.twig.php' %}

{% block link_assets %}
<link rel="stylesheet" href="css/home/main.css">
{% endblock %}

{% block script_assets %}
<script type="text/javascript" src="js/home/main.js"></script>
{% endblock %}

{% block body %}
{% if urlData %}
    <div class="container">
        <div class=" p-3 mx-5 bg-danger text-light rounded-3">
            <h3 style="font-size: 1em;" class="fw-bolder">
                Erro:
            </h3>
            <p class="mb-0">
                {{ urlData['error'] }}
            </p>
        </div>
    </div>
{% endif %}
<main class="container">
    <article class="my-5">
        <h1>
            Registros de clientes:
        </h1>
        <section class="my-4">
            <div class="text-end mb-4">
                <button class="bg-success fw-bolder text-light rounded py-1 px-3 border-0" onclick="show_edit_container([], 'users/add-new')">
                    Adicionar novo
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID de cliente</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {% for user in users %}
                    <tr>
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.nome }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <button onclick="show_edit_container( [ '{{ user.id }}', '{{ user.nome }}', '{{ user.email }}' ], 'users/update' )" class="rounded-circle d-inline-flex align-items-center justify-content-center btn-action p-3 border-0 bg-success text-light">
                                <span class="material-symbols-outlined mb-0 pb-0">
                                    edit
                                </span>
                            </button>
                            <form class="d-inline" method="post" action="users/remove">
                                <input type="hidden" name="id" value="{{ user.id }}">
                                <button class="rounded-circle d-inline-flex align-items-center justify-content-center btn-action p-3 border-0 bg-danger text-light">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </form>                            
                        </td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </section>
    </article>
    <article id="c-edit-user" class="p-4 py-4" style="display: none;">
        <div class="text-center">
            <img id="logo-edit" src="imgs/logo_alta.png">
        </div>
        <div class="d-inline position-absolute" style="top:10px;right:10px">
            <button onclick="show_edit_container()" class="border-0" style="background-color:rgba(0,0,0,0)">
                <span class="material-symbols-outlined text-danger">
                    close
                </span>
            </button>
        </div>
        <div id="c-form-edit" class="my-5">
            <form method="POST" action="users/add-new">
                <div class="mb-3">
                    <label for="i-disabled-id" class="form-label">ID do cliente</label>
                    <input type="text" name="id" value="" placeholder="Gerado automaticamente..." class="form-control" id="i-disabled-id" readonly>
                </div>
                <div class="mb-3">
                    <label for="i-nomeuser" class="form-label">Nome:</label>
                    <input type="text" name="nome" value="" class="form-control" id="i-nomeuser">
                </div>
                <div class="mb-3">
                    <label for="i-email" class="form-label">Email:</label>
                    <input type="email" name="email" value="" class="form-control" id="i-email">
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn fw-bolder text-light w-50" style="background-color: #EC6608">Alterar</button>
                </div>                
            </form>
        </div>
    </article>
</main>
{% endblock %}