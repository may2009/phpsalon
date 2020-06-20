
<style>
    .modaltest {
        margin-top: -25% !important;
        position: absolute;
        margin-left: 25%;
    }

</style>
<div class="container box" >
    <button type="button" onclick="showadd()"  class="btn btn-success">ajouter</button>



    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>name:</th>
            <th> pren:</th>
         <!--   <th> city: </th>-->
            <th class="text-right">Action</th>
        </tr>
        </thead>


        <tbody>
        <?php foreach ($test as $tst) : ?>
            <tr>
                <td><?php echo $tst["id"]; ?></td>
                <td><?php echo $tst["firstname"]; ?></td>
                <td><?php echo $tst["lastname"] ;?></td>
              <!--  <td><?php /*echo $tst["city"];*/?></td>-->
                <td class="text-right">
                     <button type="button" onclick="showedit(this.id)" id="<?= $tst['id'] ?>" class="btn btn-primary">Edite</button>
<!--
                    <a href="<?php /*echo base_url('table/delete').'/'.$tst['id'] */?>" class="btn btn-danger" id="supp">Delete</a>
-->
                    <button type="button" onclick="showdelete(this.id);" name="delete" id="<?= $tst['id'] ?>"  class="btn btn-danger">Delete</button>

                    <!-- <a href="<?php /*echo base_url('table/update').'/'.$tst['id'] */?>" class="button button-blue">update</a>-->
                    <!--   <a href="<?php /*base_url() */?>table/delete" class="btn btn-success"<?php /*echo $tst["id"]; */?> >delete</a>-->

                </td>
            </tr>
        <?php endforeach ;?>
        </tbody>

    </table>


</div>
<!--modal add-->
<div style="display: none"  id="showadd" class="modaltest">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
                <form method="post" id="user_form" action="<?=base_url();?>/table/insert">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" onclick="btnclose()">&times;</button>
                            <h4 class="modal-title" id="titremodal">Add User</h4>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="id" id="idfrm"  class="form-control hidden" />

                            <label>Enter First Name</label>
                            <input type="text" name="firstname" value="<?php  if(isset($info['firstname'])){echo $info['firstname']; }?>"  id="firstname" class="form-control" />
                            <br />
                            <label>Enter Last Name</label>
                            <input type="text" name="lastname"  value=" <?php  if(isset($info['lastname'])){echo $info['lastname'];} ?>" id="lastname" class="form-control" />
                            <br />
                            <!--  <label>Select User Image</label>
                              <input type="file" name="user_image" id="user_image" />-->
                        </div>
                        <div class="modal-footer">
                            <input type="submit"  id="submtform" class="btn btn-success" value="Ajouter" />


                            <button type="button" class="btn btn-default" onclick="btnclose()">Close</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>
<!--Modal delete-->
<div style="display: none"  id="showdelete" class="modaltest">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="btnclose()">&times;</button>
                <h3 class="modal-title">Voulez vous vraiment supprimer ?</h3>
            </div>

            <div class="modal-footer">
                <a type="button" class="btn btn-danger"  id="spr">Supprimer</a>
                <button type="button" class="btn btn-default" onclick="btnclose()">Close</button>
            </div>
        </div>
    </div>
</div>
<script>



    function showedit(id) {

        $(".modaltest").hide();
        $("#showadd").show();
        $("#titremodal").text("Edit User");
        $("#submtform").val("Modifier");
        $("#user_form").attr("action","<?=base_url();?>/table/update");

        $.getJSON( "<?=base_url();?>/table/table_update/"+id, function(data) {

            $("#firstname").val(data[0].firstname);
            $("#lastname").val(data[0].lastname);
            $("#idfrm").val(data[0].id);


        });


    }

    function showadd() {

        $("#firstname").val("");
        $("#lastname").val("");
        $("#idfrm").val("");

        $(".modaltest").hide();
       $("#showadd").show();
        $("#titremodal").text("Add User");
        $("#submtform").val("Ajouter");
        $("#user_form").attr("action","<?=base_url();?>/table/insert");


    }

    function showdelete(id) {
        $(".modaltest").hide();
       $("#showdelete").show();
       $('#spr').attr("href","<?=base_url();?>/table/delete/"+id);
    }

    function btnclose() {
        $(".modaltest").hide();
    }

</script>