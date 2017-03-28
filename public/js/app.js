$('body').on('click', '.show-emprestimo-modal', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('title');

    $('#emprestimo-title').text(title);
    $('#emprestimo-save-btn').text(me.hasClass('edit') ? 'Atualizar' : 'Salvar');

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response) {
            $('#emprestimo-body').html(response);
        }
    });

    $('#emprestimo-modal').modal('show');
});

function showMessage(message, element) {
    var alert = element == undefined ? "#add-new-alert" : element;
    $(alert).text(message).fadeTo(1000, 500).slideUp(500, function() {
        $(this).hide();
    });
}

function updateEmprestimoCounter() {
    var total = $('.list-group-item').length;
    $('#emprestimo-counter').text(total).next().text(total > 1 ? 'registros' : 'registro');

    showNoRecordMessage(total);
}

function showNoRecordMessage(total) {
    if(total > 0) {
        $('#emprestimo').closest('.panel').removeClass('hidden');
        $('#no-record-alert').addClass('hidden');
    } else {
        $('#emprestimo').closest('.panel').addClass('hidden');
        $('#no-record-alert').removeClass('hidden');
    }
}

$('#emprestimo-modal').on('keypress', ":input:not(textarea)", function(event) {
    return event.keyCode != 13;
});

$('#emprestimo-save-btn').click(function(event) {
    event.preventDefault();

    var form = $('#emprestimo-body form'),
        url = form.attr('action'),
        method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';

    // reset error message
    form.find('.help-block').remove();
    form.find('.form-group').removeClass('has-error');

    $.ajax({
        url: url,
        method: method,
        data: form.serialize(),
        success: function(response) {
            if (method == 'POST') {
                $('#emprestimo').prepend(response);

                showMessage("Termo de emprestimo criado.");

                form.trigger('reset');
                $('#title').focus();

                updateEmprestimoCounter();
            }
            else {
                var id = $('input[name=id]').val();
                if (id) {
                    $('#emprestimo-' + id).replaceWith(response);
                }

                $('#emprestimo-modal').modal('hide');
                showMessage("Emprestimo foi atualizado.", "#update-alert");
            }
        },
        error: function(data) {
            var errors = data.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                $.each(errors, function(key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
});

$('body').on('click', '.show-confirm-modal', function(event) {
    event.preventDefault();

    var me = $(this),
        title = me.attr('data-title'),
        action = me.attr('href');

    $('#confirm-body form').attr('action', action);
    $('#confirm-body p').html("Tem certeza que deseja deletar o termo: <strong>" + title + "</strong>");
    $('#confirm-modal').modal('show');
});

$('#confirm-remove-btn').click(function(event){
    event.preventDefault();

    var form = $('#confirm-body form'),
        url = form.attr('action');

    $.ajax({
        url: url,
        method: 'DELETE',
        data: form.serialize(),
        success: function(data) {
            $('#confirm-modal').modal('hide');

            $('#emprestimo-' + data.id).fadeOut(function(){
                $(this).remove();
                updateEmprestimoCounter();
                showMessage("Termo de emprestimo foi deletado", "#update-alert");
            });
        }
    });
});

function countActiveItem() {
    var total = $('tr.item-item:not(:has(td.done))').length;
    $('#active-item-counter').text(total + " " + (total > 1 ? 'itens' : 'item') + " faltante");
}

$('body').on('click', '.show-item-modal', function(event) {
    event.preventDefault();

    var anchor = $(this),
        url = anchor.attr('href'),
        title = anchor.data('title'),
        action = anchor.data('action'),
        parent = anchor.closest('.list-group-item');

        $("#item-modal-subtitle").text(title);
        $("#item-form").attr("action", action);
        $('#selected-emprestimo').val(parent.attr('id'));

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(response) {
            //$('#item-table-body').remove();
            $('#item-table-body').html(response);
            initIcheck();
            countActiveItem();
            updateEmprestimoCounter();
        },
        error: function(xhr) {
            var errors = xhr.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                $("#message-item").children().remove();
                $.each(errors, function(key, value) {
                    $("#message-item")
                            .append('<span class="help-block has-error"><strong>' + value + '</strong></span>')
                            .fadeTo(1000, 500)
                            .slideUp(500, function() {
                                $(this).hide();
                    });
                });
            }
        }
    });

    $('#item-modal').modal('show');
});

function countAllItensOfSelectedList() {
    var total = $('#item-table-body tr').length,
        selectedEmprestimoId = $('#selected-emprestimo').val();

        $('#' + selectedEmprestimoId).find('span.badge').text(total + " " + (total > 1 ? 'itens' : 'item'));
}

$('#item-form').submit(function(e) {
    e.preventDefault();

    var form = $(this),
        action = form.attr('action');

    $.ajax({
        url: action,
        type: 'POST',
        data: form.serialize(),
        success: function(response){
            $('#item-table-body').prepend(response);
            form.trigger('reset');
            countActiveItem();
            initIcheck();
            countAllItensOfSelectedList();
        },
        error: function(xhr) {
            var errors = xhr.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                $("#message-item").children().remove();
                $.each(errors, function(key, value) {
                    $("#message-item")
                            .append('<span class="help-block has-error"><strong>' + value + '</strong></span>')
                            .fadeTo(1000, 500)
                            .slideUp(500, function() {
                                $(this).hide();
                    });
                });
            }
        }
    });
});

function markTheItem(checkbox) {
    var url = checkbox.data('url'),
        entregue = checkbox.is(":checked");

    $.ajax({
        url: url,
        type: 'PUT',
        data: {
            entregue: entregue,
            _token: $("input[name=_token]").val()
        },
        success: function(response) {
            if(response) {
                var nextTd = checkbox.closest('td').next();

                if(entregue) {
                    nextTd.addClass('done');
                }
                else {
                    nextTd.removeClass('done');
                }

                countActiveItem();
            }
        }
    });
}

function initIcheck() {
    $('input[type=checkbox]').iCheck({
        checkboxClass: 'icheckbox_square-green',
        increaseArea: '20%'
    });

    $('#check-all').on('ifChecked', function(e) {
        $('.check-item').iCheck('check');
    });

    $('#check-all').on('ifUnchecked', function(e) {
        $('.check-item').iCheck('uncheck');
    });

    $('.check-item')
        .on('ifChecked', function(e) {
            var checkbox = $(this);
            markTheItem(checkbox);
        })
        .on('ifUnchecked', function(e){
            var checkbox = $(this);
            markTheItem(checkbox);
        });

}

$(".filter-btn").click(function(e) {
    e.preventDefault();

    var id = this.id;

    $(this).addClass('active')
            .parent()
            .children()
            .not(e.target)
            .removeClass('active');

    if(id == "all-item") {
        $('tr.item-item').show();
    }
    else if (id == "active-item") {
        $('tr.item-item:has(td.done)').hide();
        $('tr.item-item:not(:has(td.done))').show()
    }
    else if (id == "completed-item") {
        $('tr.item-item:has(td.done)').show();
        $('tr.item-item:not(:has(td.done))').hide();
    }
});

$('#item-table-body').on('click', '.remove-item-btn', function(e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: $('input[name=_token]').val()
        },
        success: function(response) {
            $('#item-' + response.id).fadeOut(function() {
                $(this).remove();
                countActiveItem();
                countAllItensOfSelectedList();
            });
        }
    });
});
