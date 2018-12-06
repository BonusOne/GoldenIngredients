<?php $AllProducts = $this->get('AllProducts'); ?>
<section id="Index" class="col-xs-12">
    <div class="col-xs-12 col-md-8 col-md-offset-2 Index">
         Select the product from list below
         <div class="clearfix" style="height: 5px;"></div>
         <select id="SelectProduct" name="SelectProduct" class="form-control" style="width: 200px;">
         <option value="" selected=""></option>
         <?php 
            for($i = 0; $i < count($AllProducts); $i++){
                echo '<option value="'.$AllProducts[$i]['id_products'].'" data-name"'.$AllProducts[$i]['name'].'">'.$AllProducts[$i]['name'].'</option>';
            }
         ?>
         </select>
         <div class="clearfix" style="height: 20px;"></div>
         Set weight of product in kilograms <small>(eg. 1 or 0.5)</small>
         <div class="clearfix" style="height: 5px;"></div>
         <input type="text" name="Kilograms" id="Kilograms" value="1" class="form-control" style="width: 200px;" />
         <div class="clearfix" style="height: 20px;"></div>
         This product contains <small>(in grams)</small>:
         <div class="clearfix" style="height: 5px;"></div>
         <div class="Ingredients">
         
         </div>
        <div class="clearfix" style="height: 20px;"></div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function () {
    $('#SelectProduct, #Kilograms').change(function(){
        $('.Ingredients').html();
        var Prod = $(this).val();
        var Nam = $('#SelectProduct option:selected').text();
        var Kilo = $('#Kilograms').val();
        $.ajax({ 
            type: 'GET', 
            url: '/index/getProductContainsCountIngredientsNutrients', 
            data: { Product : Prod },
            dataType: 'json',
            success: function (data) {
                $('.Ingredients').html(Kilo+"kg of "+Nam+" contain:");
                $.each(data, function(indexMa, valueMa){
                    $('.Ingredients').append("<br />"+valueMa.ingredient+":");
                    $.each(valueMa.nutrients, function(index, value){
                        var licz = (value[1]*Kilo);
                        $('.Ingredients').append("<br />&nbsp;&nbsp;&nbsp;&nbsp;"+licz+" "+value[0]);
                    });
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr+" / "+ajaxOptions+" / "+thrownError);
            }
        });
    });
    
});
</script>