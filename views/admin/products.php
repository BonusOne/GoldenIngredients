<?php $AllProducts = $this->get('AllProducts'); ?>
<section id="adminProducts" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminProductsbox">
        <div class="col-xs-12 adminMain">
            <?php if($UserType == 2){ ?><a href="/admin/products/addProduct" class="btn btn-primary buttonAdd" style="float: right;">Add <i class="fa fa-plus"></i></a>
            <div class="clearfix" style="height: 10px;"></div><?php } ?>
            <table class="table table-striped table-hover productsTable">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <th>Grams of ingredients <small>(in 1kg)</small></th>
                    <th style="width: 120px;"></th>
                    <?php if($UserType == 2){ echo '<th style="width: 50px;">edit</th>'; }?>
                </tr>
                <?php $countData = count($AllProducts)-1;
                $lp = 1;
                for($i = 0; $i <= $countData; $i++){ ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $lp; ?></td>
                        <td><?php echo $AllProducts[$i]['name']; ?></td>
                        <td class="Ingr<?php echo $AllProducts[$i]['id_products']; ?>"></td>
                        <td><a href="/admin/addProductIngredients/<?php echo $AllProducts[$i]['id_products']; ?>">Add ingredient</a></td>
                        <?php if($UserType == 2){ ?><td style="width: 50px;"><a href="/admin/products/<?php echo $AllProducts[$i]['id_products']; ?>"><i class="fa fa-edit"></i></a></td> <?php } ?>
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
        url: '/admin/getAllProductsContainsIngredients', 
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $.each(data, function(index, e) {
                $('.productsTable td.Ingr'+e.id_product).html(e.ingradient_grams);
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr+" / "+ajaxOptions+" / "+thrownError);
        }
    });
});
</script>