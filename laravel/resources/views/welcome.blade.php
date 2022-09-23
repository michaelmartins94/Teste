<link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="/js/jquery_ui.js"></script>
<script src="/js/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/app.js"></script>

<title>Previsão do Tempo</title>

<body style="background-image: url(img/ceu.jpeg);background-repeat:no-repeat;background-size:cover;opacity: 0.9; ">
    <div class="container card"  style="margin: 50px;padding:20px">

    <div>
        <button id="nova_previsao" class="btn btn-block btn-success modal_add">Nova Previsão</button>
    </div>
    <div>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Dia</th>
                    <th>Cidade</th>
                    <th>Média</th>
                    <th>Minima</th>
                    <th>Máxima</th>
                    <th>Pressão</th>
                    <th>Nível do mar</th>
                    <th>Umidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>23/09/2022 </td>
                    <td>New York</td>
                    <td>26°</td>
                    <td>30°</td>
                    <td>22°</td>
                    <td>957</td>
                    <td>1039</td>
                    <td>90</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-block btn-sm modal_edit" previsao_id="">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-danger btn-block btn-sm modal_remove" previsao_id="">
                            <i class="fa fa-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
   </div>
</body>

<!-- Modal -->
<div class="modal"  id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nova Previsão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form_add" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Data</label>
                    <input class="form-control campo_obrigatorio date" placeholder="" id="identification"/>
                    <span class="error invalid-feedback">Campo inválido</span>
                    <br>
                    <label>Cidade</label>
                    <select class="form-select campo_obrigatorio" aria-label="Default select example">
                        <option selected></option>
                        <option value="1">New York</option>
                        <option value="1">London</option>
                        <option value="1">Paris</option>
                        <option value="1">Berlin</option>
                        <option value="1">Tokyo</option>
                    </select>
                    <span class="error invalid-feedback">Campo inválido</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="save" post_id="">Salvar</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal"  id="add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Excluir Previsão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Deseja realmente excluir esta previsão ?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-primary" id="remove_previsao" data-bs-dismiss="modal">Sim</button>
        </div>
    </div>
  </div>


  