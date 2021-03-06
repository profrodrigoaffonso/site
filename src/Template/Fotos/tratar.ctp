<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Command $command
 */
?>
    <h1 class="text-center">Tratar Fotos</h1>


    <?= $this->Form->create(null, ['type' => 'file']) ?>
    <div class="form-group">
    <?php
            echo $this->Form->control('image', ['class' => 'form-control', 'label' => false, 'name' => 'imagens[]', 'type' => 'file', 'multiple' => 'multiple']);
        ?>
    </div>
    <?= $this->Form->button(__('Enviar'), ['class' => "btn btn-primary"]) ?>
    <?= $this->Form->end() ?>
    
    <?php

    // echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
    //     while($arquivo = $diretorio -> read()){
    //         if($arquivo != '.' && $arquivo != '..' && $arquivo != 'marcaretrato.png' && $arquivo != 'marcaretrato.gif')
    //             echo "<a href='/fotos/file_download/".$arquivo."'><img width='100' src='/uploads/{$arquivo}'></a><br />";
    //     }
    //     $diretorio -> close();
        ?>
<div class="row">
<?php
    while($arquivo = $diretorio -> read()){
        if($arquivo != '.' && $arquivo != '..' && $arquivo != 'marcaretrato.png' && $arquivo != 'marcaretrato.gif')
            echo "
                <div class='col-2'>
                    <img width='200' class='img-thumbnail' src='/uploads/{$arquivo}' onclick='openModal(\"/uploads/{$arquivo}\")'>
                    <a href='/fotos/file_download/".$arquivo."' class='btn-sm btn-block btn btn-primary'>Baixar</a>
                </div>";
            }
    $diretorio -> close();

?>
</div>
<div class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="imgModal"></div>
    </div>
  </div>
</div>
<script>
    function openModal(img){
        $('#imgModal').html('<img class="img-fluid" src="' + img + '">')
        $('.modal').modal()
    }
</script>
