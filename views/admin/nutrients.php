<?php $AllNutrients = $this->get('AllNutrients'); ?>
<section id="adminNutrients" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminNutrientsbox">
        <div class="col-xs-12 adminMain">
            <?php if($UserType == 2){ ?><a href="/admin/nutrients/addNutrient" class="btn btn-primary buttonAdd" style="float: right;">Add <i class="fa fa-plus"></i></a>
            <div class="clearfix" style="height: 10px;"></div><?php } ?>
            <table class="table table-striped table-hover NutrientsTable">
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Name</th>
                    <?php if($UserType == 2){ echo '<th style="width: 50px;"></th>'; }?>
                </tr>
                <?php $countData = count($AllNutrients)-1; 
                $lp = 1;
                for($i = 0; $i <= $countData; $i++){ ?>
                    <tr>
                        <td style="width: 50px;"><?php echo $lp; ?></td>
                        <td><?php echo $AllNutrients[$i]['name']; ?></td>
                        <?php if($UserType == 2){ ?><td style="width: 50px;"><a href="/admin/nutrients/<?php echo $AllNutrients[$i]['id_nutrients']; ?>"><i class="fa fa-edit"></i></a></td> <?php } ?>
                    </tr>
                <?php $lp++;} ?>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</section>