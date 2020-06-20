
<!--<div class="container " >

    <div class="row content">

        <h3>You can change your info here :<?php /* if(isset($info['firstname'])){echo $info['firstname']; }*/?></h3>-->



        <div class="form-group">

            <label for="firstname">Name:</label>

            <input type="text" name="firstname" value="<?php  if(isset($info['firstname'])){echo $info['firstname']; }?>" id="firstname" class="form-control" required="" maxlength="50">

        </div>
        <br/>


        <div class="form-group">

            <label for="lastname">Lastname:</label>

            <input type="text" name="lastname" value=" <?php  if(isset($info['lastname'])){echo $info['lastname'];} ?>" id="firstname" class="form-control" required="" maxlength="50">

        </div>
        <br/>



        <div class="form-group">

            <label for="city">City:</label>

            <input type="text" name="city" value="
        <?php  if(isset($info['city'])){echo $info['city'];} ?>" id="city" class="form-control" required="" maxlength="50">

        </div>

        <br/>


<div class="form-group">

    <a href="<?php echo base_url('table_update').'/'.$info['id'];?>"><input type="button" class="btn-primary" value="Edite"></a>

    <a href="<?php echo base_url('table_update').'/'.$info['id'];?>" class="btn-primary" > Edite</a>


</div>




<!--

    </div>
</div>-->