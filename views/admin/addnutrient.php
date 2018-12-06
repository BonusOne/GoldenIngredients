<section id="adminNutrients" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminNutrients">
    <?php if($UserType == 2){ ?>
        <div class="col-xs-12 adminMain">
        <h3 style="margin-bottom: 30px;">Add nutrients</h3>
        <?php $error = Session::get('AddError');
        $good = Session::get('AddApply');
        $AddNutrientsName = Session::get('AddNutrientName');
        Session::uset('AddNutrientsName');
        Session::uset('AddError');
        Session::uset('AddApply');
        if(isset($error)) { ?>
            <div class="LogErr"><?php echo $error; ?></div>
            <div class="clearfix"></div>
        <?php } elseif (isset($good)){ ?>
            <div class="LogApply"><?php echo $good; ?></div>
            <div class="clearfix"></div>
        <?php } ?>
        <form action="" id="EditForm" method="POST" name="EditForm" class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="form-group <?php if(isset($error) and (strpos($error, 'Title') !== false)){ echo "has-error"; } ?>">
                <label for="NutrientsName">Name nutrient</label>
                <input type="text" id="NutrientsName" name="nutrientsname" class="form-control" required="" value="<?php if(isset($AddNutrientsName) and $AddNutrientsName != '' and $AddNutrientsName != NULL){ echo $AddNutrientsName; } ?>" />
            </div>
            <div class="clearfix" style="height: 10px; border-top: 1px solid #EEE; margin-top: 20px;"></div>
            <a href="/admin/nutrients" style="float: left;">Cancel</a>
            <button name="submit" type="submit" id="SubmitButton" class="btn btn-primary buttonApply" style="float: right;" disabled="">Add&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
        </form>
        </div>
    <?php } else { ?>
        You do not have permission to add
    <?php } ?>
        <div class="clearfix"></div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#EditForm input').change(function(){
        var dis = 0;
        if(!$(this).val()){
            $(this).addClass('error');
            $(this).parent(".form-group").addClass("has-error");
        } else {
            $(this).removeClass('error');
            $(this).parent(".form-group").removeClass("has-error");
        }
        $('#EditForm input').each(function(){
            if($(this).val()){
                dis++;
            }
            if(dis >= 1){
                $("#SubmitButton").prop('disabled', false);
            } else {
                $("#SubmitButton").prop('disabled', true);
            }
        });
    });    
    
    
});
</script>