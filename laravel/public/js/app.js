$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.date').inputmask('99/99/9999');
    $('#table_id').dataTable(
        {
            "bSort": false,
            "orderable": true,
            "bStateSave": true,
            "paging": true,
            "bLengthChange": false,
            "oLanguage": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        }
    );

    $("#data").change(function(){
        let data = moment($(this).val());

        if(!data.isValid()){
            $(this).val('');
        }
    });

    $("#form_add").unbind('submit');
    $("#form_add").submit(async function(e) {
        e.preventDefault();
        let error = '';

        let id = $("#save").attr('previsao_id');
        
        $(".campo_obrigatorio").each(async function() {
            if($(this).val().trim() == ''){
                error = 1;
                if($(this).hasClass('is-valid')){
                    $(this).removeClass('is-valid');
                }
                $(this).addClass('is-invalid');
            }else{
                if($(this).hasClass('is-invalid')){
                    $(this).removeClass('is-invalid');
                }
                $(this).addClass('is-valid');
            }
        });
        
        if(error == ''){
            $.ajax({
                type: 'POST',
                url:"add",
                data: {
                    id:id,
                    data: $("#data").val(),
                    cidade_id: $("#cidade option:selected").val()
                },
                success: function(data) {
                    toastr.success(data.msg);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        }
        
    });

    $('.modal_add').click(function(){
        $(".campo_obrigatorio").val('');
        $(".campo_obrigatorio").removeClass('is-valid');
        $(".campo_obrigatorio").removeClass('is-invalid');
        $('#add').modal('show');
    });

    $('.modal_edit').click(function(){
        $(".campo_obrigatorio").val('');
        $(".campo_obrigatorio").removeClass('is-valid');
        $(".campo_obrigatorio").removeClass('is-invalid');

        let previsao_id = $(this).attr('previsao_id');

        $("#save").attr('previsao_id',previsao_id);

        $.ajax({
            type: 'POST',
            url: "edit",
            data: {
                id: previsao_id
            },
            success: function(data) {
                $("#data").val(data.data),
                $("#cidade option[value="+data.cidade_id+"]").attr('selected','selected');
                $('#add').modal('show');
            }
        });
       
        
    });

    $('.modal_remove').click(function(){
        $('#remove').modal('show');
        $('#remove_previsao').attr('previsao_id',$(this).attr('previsao_id'));
    });

    $('#remove_previsao').click(function(){
        let previsao_id = $(this).attr('previsao_id');

        $.ajax({
            type: 'DELETE',
            url: "delete",
            data: {
                id: previsao_id
            },
            success: function(data) {
                $('.modal_remove[previsao_id='+previsao_id+']').closest('tr').html('');
                toastr.success(data.msg);
            }
        });
    });

});