<?php $countData = $this->get('countData')[0]; ?>
<section id="admin" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminbox">
        <?php /*<div class="col-xs-12 divh2">Panel Administracyjny</div>*/ ?>
        <div class="col-xs-12 adminMain">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6" style="margin: 0 auto; display: block; float: none;">
                <h3 style="margin-bottom: 15px;">Data in database</h3>
                <table class="table table-striped table-hover mainTable">
                    <tr>
                        <th></th>
                        <th style="text-align: center;">Sum</th>
                    </tr>
                    <tr>
                        <td>All products</td>
                        <td style="text-align: center;"><?php echo $countData['product']; ?></td>
                    </tr>
                    <tr>
                        <td>All ingredients</td>
                        <td style="text-align: center;"><?php echo $countData['ingredients']; ?></td>
                    </tr>
                    <tr>
                        <td>All nutrients</td>
                        <td style="text-align: center;"><?php echo $countData['nutrients']; ?></td>
                    </tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                </table>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>