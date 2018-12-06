<?php $Product = $this->get('Product')[0]; ?>
<section id="adminProducts" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminProductsbox">
    <?php if($UserType == 2){ ?>
        <div class="col-xs-12 adminMain">
        <h3 style="margin-bottom: 30px;">Edit product</h3>
        <?php $error = Session::get('EditError');
        $good = Session::get('EditApply');
        $EditName = Session::get('EditProductsName');
        Session::uset('EditProductsName');
        Session::uset('EditError');
        Session::uset('EditApply');
        if(isset($error)) { ?>
            <div class="LogErr"><?php echo $error; ?></div>
            <div class="clearfix"></div>
        <?php } elseif (isset($good)){ ?>
            <div class="LogApply"><?php echo $good; ?></div>
            <div class="clearfix"></div>
        <?php } ?>
        <form action="" id="EditForm" method="POST" name="EditForm" class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div class="form-group <?php if(isset($error) and (strpos($error, 'Title') !== false)){ echo "has-error"; } ?>">
                <label for="ProductsName">Name products</label>
                <input type="text" id="ProductsName" name="productsname" class="form-control" required="" value="<?php if(isset($EditName) and $EditName != '' and $EditName != NULL){ echo $EditName; } else { echo $Product['name']; } ?>" />
            </div>
            <div class="clearfix" style="height: 10px; border-top: 1px solid #EEE; margin-top: 20px;"></div>
            <a href="/admin/products" style="float: left;">Cancel</a>
            <button name="submit" type="submit" id="SubmitButton" class="btn btn-primary buttonApply" style="float: right;">Save&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></button>
        </form>
        </div>
    <?php } else { ?>
        You do not have permission to edit
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
                //$('#SubmitCont').addClass('active');
                $("#SubmitButton").prop('disabled', false);
            } else {
                $("#SubmitButton").prop('disabled', true);
            }
        });
    });
});
</script>