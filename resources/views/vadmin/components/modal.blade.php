<div id="{{ $id }}" class="modal fade BsModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $title }}</h4>
      </div>
      <div class="modal-body">
        {{ $content }}
      </div>
      <div class="modal-footer">
        {{ $ok_button }}
        <button type="button" class="CloseModal button buttonCancel" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


