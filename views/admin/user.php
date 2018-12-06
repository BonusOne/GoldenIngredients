<?php $User = $this->get('User')[0]; ?>
<section id="adminUsers" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminUsersbox">
    <?php if($UserType == 2){ ?>
        <div class="col-xs-12 adminMain">
            <h3 style="margin-bottom: 30px;">Edycja użytkownika</h3>
        <?php $error = Session::get('EditError');
        $good = Session::get('EditApply');
        $UserImie = Session::get('UserImie');
        $UserNazwisko = Session::get('UserNazwisko');
        $UserTyp = Session::get('UserTyp');
        Session::uset('UserImie');
        Session::uset('UserNazwisko');
        Session::uset('UserTyp');
        Session::uset('EditError');
        Session::uset('EditApply');
        if(isset($error)) { ?>
            <div class="LogErr"><?php echo $error; ?></div>
            <div class="clearfix"></div>
        <?php } elseif (isset($good)){ ?>
            <div class="LogApply"><?php echo $good; ?></div>
            <div class="clearfix"></div>
        <?php } ?>
        <form action="" id="EditUserForm" method="POST" name="EditUserForm">
            <div class="form-group">
                <label for="UserEmail">Email</label>
                <input type="text" id="UserEmail" name="useremail" class="form-control" value="<?php echo $User['email']; ?>" readonly="" disabled="" />
            </div>
            <div class="form-inline" style="margin-bottom: 15px;">
                <div class="form-group col-xs-12 col-sm-6" style="padding-left: 0px;">
                    <label for="UserImie">Imię</label>
                    <div class="clearfix"></div>
                    <input type="text" id="UserImie" name="userimie" class="form-control" required="" value="<?php if(isset($UserImie) and $UserImie != '' and $UserImie != NULL){ echo $UserImie; } else { echo $User['firstname']; } ?>" />
                    <div class="clearfix"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 divVideoAlias" style="padding-right: 0px;">
                    <label for="UserNazwisko">Nazwisko</label>
                    <div class="clearfix"></div>
                    <input type="text" id="UserNazwisko" name="usernazwisko" style="width: 100%;" required="" class="form-control" value="<?php if(isset($UserNazwisko) and $UserNazwisko != '' and $UserNazwisko != NULL){ echo $UserNazwisko; } else { echo $User['lastname']; } ?>" />
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-inline" style="margin-bottom: 15px;">
                <div class="form-group  col-xs-12 col-sm-6" style="padding-left: 0px;">
                    <label for="UserType">Typ</label>
                    <div class="clearfix"></div>
                    <select class="form-control" name="usertype" id="UserType" style="width: 250px;">
                        <option value="1" <?php if($User['type'] == 1 or $User['type'] == '1'){ echo "selected=''"; } ?>>Zarejestrowany</option>
                        <option value="2" <?php if($User['type'] == 2 or $User['type'] == '2'){ echo "selected=''"; } ?>>Administrator</option>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-6" style="padding-right: 0px;">
                    <label>Data rejestracji</label><div class="clearfix"></div>
                    <p class="form-control-static"><?php echo $User['datetime']; ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            <div class="form-inline" style="margin-bottom: 15px;">
            <div class="clearfix" style="height: 10px;"></div>
            <button name="submit" type="submit" id="SubmitButton" class="btn btn-primary buttonApply" style="float: right;">Zatwierdź&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
            <div class="clearfix"></div>
        </form>
        <div class="clearfix" style="height: 10px; border-top: 1px solid #EEE; margin-top: 30px;"></div>
        <form action="" id="EditUserPassForm" method="POST" name="EditUserPassForm">
            <div class="form-group">
                <label for="UserPass">Zmień hasło</label>
                <input type="password" id="UserPass" name="userpass" style="width: 100%;" required="" class="form-control" value="" />
            </div>
            <button name="submitPass" type="submit" id="SubmitButtonPass" class="btn btn-primary buttonApply" style="margin-top: 25px; margin-left: 20px;" disabled="">Zmień&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
        </form>
        <div class="clearfix" style="height: 10px; border-top: 1px solid #EEE; margin-top: 30px;"></div>
        <a href="/admin/users" style="float: left;">Anuluj</a>
        </div>
    <?php } else { ?>
        Nie posiadasz uprawnień do edycji
    <?php } ?>
        <div class="clearfix"></div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#EditUserForm input').change(function(){
        var dis = 0;
        if(!$(this).val()){
            $(this).addClass('error');
            $(this).parent(".form-group").addClass("has-error");
        } else {
            $(this).removeClass('error');
            $(this).parent(".form-group").removeClass("has-error");
        }
        $('#EditUserForm input').each(function(){
            if($(this).val()){
                dis++;
            }
            if(dis >= 3){
                //$('#SubmitCont').addClass('active');
                $("#SubmitButton").prop('disabled', false);
            } else {
                $("#SubmitButton").prop('disabled', true);
            }
        });
    });
    $('#EditUserPassForm input').change(function(){
        var dis = 0;
        if(!$(this).val()){
            $(this).addClass('error');
            $(this).parent(".form-group").addClass("has-error");
            $("#SubmitButtonPass").prop('disabled', true);
        } else {
            $(this).removeClass('error');
            $(this).parent(".form-group").removeClass("has-error");
            $("#SubmitButtonPass").prop('disabled', false);
        }
    });
});
</script>