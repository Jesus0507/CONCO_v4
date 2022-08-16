<div class="modal fade" id="ver_permisos">
    <div class="modal-dialog modal-xl" style="max-width: 150vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_permisos">Permisos del Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style='overflow-y: scroll;height: 350px'>
                <form action="" enctype="multipart/form-data" id="registro" method="POST" name="registro">

                    <table style="width: 100%">
                        <thead style="color:white;background: #073E4D">
                            <th style="text-align: center">Modulo </th>
                            <th style="text-align: center">Registrar <span class='fa fa-minus-circle negativoHead' title='Denegar para todos los modulos' onclick='changePermisosHead(1,this)'></span></th>
                            <th style="text-align: center" >Consultar <span class='fa fa-minus-circle negativoHead' title='Denegar para todos los modulos' onclick='changePermisosHead(2,this)'></span></th>
                            <th style="text-align: center">Modificar <span class='fa fa-minus-circle negativoHead' title='Denegar para todos los modulos' onclick='changePermisosHead(3,this)'></span></th>
                            <th style="text-align: center">Eliminar <span class='fa fa-minus-circle negativoHead' title='Denegar para todos los modulos' onclick='changePermisosHead(4,this)'></span></th>
                        </thead>
                        <tbody id="body-permisos">

                        </tbody>
                    </table>

                      <input type="hidden" id='tipo_usuario_selected' name="">
                </form>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- /.modal -->