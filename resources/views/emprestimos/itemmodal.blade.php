<div class="modal fade" id="item-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gerenciar Itens</h4>
        <p>de <strong id="item-modal-subtitle"></strong></p>
      </div>
      <div class="modal-body">

          <div id="message-item"></div>

        <div class="panel panel-default">
            <table class="table">
                <thread>
                    <td width="50" style="vertical-align: middle;">
                        <input type="checkbox" name="check_all" id="check-all">
                    </td>
                    <td>
                        <form id="item-form">
                            {{ csrf_field() }}
                            <input type="hidden" id="selected-emprestimo">
                            <input type="text" name="descricao" id="item-descricao" placeholder="Cadastre um novo item" class="item-input">
                        </form>
                    </td>
                </thread>
                <tbody id="item-table-body"></tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer clearfix">
        <div class="pull-left">
            <a id="all-item" class="btn btn-xs btn-default filter-btn active">Todos</a>
            <a id="active-item" class="btn btn-xs btn-default filter-btn">Ativos</a>
            <a id="completed-item" class="btn btn-xs btn-default filter-btn">Completados</a>
        </div>
        <div class="pull-right">
            <small id="active-item-counter"></small>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
