<?php $AllIngredients = $this->get('AllIngredients'); ?>
<section id="adminIngredients" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminIngredientsbox">
        <div class="col-xs-12 adminMain">
            <?php if($UserType == 2){ ?><a href="/admin/ingredients/addIngredient" class="btn btn-primary buttonAdd" style="float: right;">Add <i class="fa fa-plus"></i></a>
            <div class="clearfix" style="height: 10px;"></div><?php } ?>
            <table class="table table-striped table-hover ingredientsTable">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <th>Grams of nutrients <small>(in 100g)</small></th>
                    <th style="width: 100px;"></th>
                    <?php if($UserType == 2){ echo '<th style="width: 50px;">edit</th>'; }?>
                </tr>
                <?php $countData = count($AllIngredients)-1;
                $lp = 1;
                for($i = 0; $i <= $countData; $i++){ ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $lp; ?></td>
                        <td><?php echo $AllIngredients[$i]['name']; ?></td>
                        <td class="Nutr<?php echo $AllIngredients[$i]['id_ingredient']; ?>"></td>
                        <td><a href="/admin/addNutrientIngredients/<?php echo $AllIngredients[$i]['id_ingredient']; ?>">Add nutrient</a></td>
                        <?php if($UserType == 2){ ?><td style="width: 50px;"><a href="/admin/ingredients/<?php echo $AllIngredients[$i]['id_ingredient']; ?>"><i class="fa fa-edit"></i></a></td> <?php } ?>
                    </tr>
                <?php $lp++;} ?>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function () {
    $.ajax({ 
        type: 'GET', 
        url: '/admin/getAllIngredientsContainsNutrients', 
        dataType: 'json',
        success: function (data) {
            $.each(data, function(index, e) {
                $('.ingredientsTable td.Nutr'+e.id_ingredient).html(e.nutrients_in100grams);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr+" / "+ajaxOptions+" / "+thrownError);
        }
    });
});
</script>