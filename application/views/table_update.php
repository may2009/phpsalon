
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update  Info</h4>
    </div>
    <div class="modal-body">

        <form method="post"  id="update" action="<?= base_url();?>table/update_submit" >

            <input type="hidden" name="id" value="<?php  if(isset($info['id'])){
                /** @var TYPE_NAME $info */
                echo $info['id']; }?>" class="form-control" maxlength="50">

            <div class="form-group">
                <label for="firstname">firstName:</label>
                <input type="text" value="<?php  if(isset($info['firstname'])){echo $info['firstname']; }?>" name="firstname" id="firstname" class="form-control" required maxlength="50">
            </div>
            <div class="form-group">
                <label for="lastname">lastname:</label>
                <input type="text" value="<?php  if(isset($info['lastname'])){echo $info['lastname']; }?>" class="form-control" name="lastname" id="lastname" required maxlength="50">
            </div>
            <div class="form-group">
                <label for="contact">City:</label>
                <input type="text"  value="<?php  if(isset($info['city'])){echo $info['city']; }?>"class="form-control" name="city" id="city" required  maxlength="50">
            </div>


            <div class="form-group mb-50">

                <input type="submit" class="btn-primary"  value="Update"/>

            </div>

        </form>


    </div>
    <div class="modal-footer">
        <a href="<?=base_url();?>table" type="button" class="btn btn-danger " data-dismiss="modal">Close</a>
    </div>
</div>

</div>






