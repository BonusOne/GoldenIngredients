<section id="adminUsers" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminUsersbox">
    <?php if($UserType == 2){ ?>
        <div class="col-xs-12 adminMain">
            <h3 style="margin-bottom: 30px;">Dodaj użytkownika</h3>
        <?php $error = Session::get('AddError');
        $good = Session::get('AddApply');
        $UserImie = Session::get('AddUserImie');
        $UserNazwisko = Session::get('AddUserNazwisko');
        $UserTyp = Session::get('AddUserTyp');
        $UserEmail = Session::get('AddUserEmail');
        Session::uset('AddUserImie');
        Session::uset('AddUserNazwisko');
        Session::uset('AddUserTyp');
        Session::uset('AddUserEmail');
        Session::uset('AddError');
        Session::uset('AddApply');
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
                <input type="text" id="UserEmail" name="useremail" class="form-control" value="<?php if(isset($UserEmail) and $UserEmail != '' and $UserEmail != NULL){ echo $UserEmail; } ?>" />
            </div>
            <div class="form-inline" style="margin-bottom: 15px;">
                <div class="form-group col-xs-12 col-sm-6" style="padding-left: 0px;">
                    <label for="UserImie">Imię</label>
                    <div class="clearfix"></div>
                    <input type="text" id="UserImie" name="userimie" class="form-control" required="" value="<?php if(isset($UserImie) and $UserImie != '' and $UserImie != NULL){ echo $UserImie; } ?>" />
                    <div class="clearfix"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-6 divVideoAlias" style="padding-right: 0px;">
                    <label for="UserNazwisko">Nazwisko</label>
                    <div class="clearfix"></div>
                    <input type="text" id="UserNazwisko" name="usernazwisko" style="width: 100%;" required="" class="form-control" value="<?php if(isset($UserNazwisko) and $UserNazwisko != '' and $UserNazwisko != NULL){ echo $UserNazwisko; } ?>" />
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-inline" style="margin-bottom: 15px;">
                <div class="form-group  col-xs-12 col-sm-6" style="padding-left: 0px;">
                    <label for="UserType">Typ</label>
                    <div class="clearfix"></div>
                    <select class="form-control" name="usertype" id="UserType" style="width: 250px;">
                        <option value="1" <?php if(isset($UserTyp) and ($UserTyp == 1 or $UserTyp == '1')){ echo "selected=''"; } ?>>Zarejestrowany</option>
                        <option value="2" <?php if(isset($UserTyp) and ($UserTyp == 2 or $UserTyp == '2')){ echo "selected=''"; } ?>>Administrator</option>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-6" style="padding-right: 0px;">
                    <label for="UserPass">Hasło</label>
                    <div class="clearfix"></div>
                    <input type="password" id="UserPass" name="userpass" style="width: 100%;" required="" class="form-control" value="" />
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            <div class="form-inline" style="margin-bottom: 15px;">
            <div class="clearfix" style="height: 10px; border-top: 1px solid #EEE; margin-top: 20px;"></div>
            <a href="/admin/users" style="float: left;">Anuluj</a>
            <button name="submit" type="submit" id="SubmitButton" class="btn btn-primary buttonApply" style="float: right;">Zatwierdź&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
        </form>
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
});
</script>