<?php $AllUsers = $this->get('AllUsers'); ?>
<section id="adminUsers" class="col-xs-12">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 adminUsersbox">
        <div class="col-xs-12 adminMain">
            <?php if($UserType == 2){ ?><a href="/admin/users/addUser" class="btn btn-primary buttonAdd" style="float: right;">Dodaj <i class="fa fa-plus"></i></a>
            <div class="clearfix" style="height: 10px;"></div><?php } ?>
            <table class="table table-striped table-hover usersTable">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Data dodania</th>
                    <th>Typ</th>
                    <?php if($UserType == 2){ echo '<th></th>'; }?>
                </tr>
                <?php $countUsers = count($AllUsers)-1;
                for($i = 0; $i <= $countUsers; $i++){ ?>
                    <tr>
                        <td><?php echo $AllUsers[$i]['id']; ?></td>
                        <td><?php echo $AllUsers[$i]['email']; ?></td>
                        <td><?php echo $AllUsers[$i]['firstname']; ?></td>
                        <td><?php echo $AllUsers[$i]['lastname']; ?></small></td>
                        <td><?php echo $AllUsers[$i]['datetime']; ?></small></td>
                        <td><?php if($AllUsers[$i]['type'] == 2){ echo "Administrator"; } elseif($AllUsers[$i]['type'] == 1){ echo "Zarejestrowany"; } else { echo $AllUsers[$i]['type']; } ?></td>
                        <?php if($UserType == 2){ ?><td><a href="/admin/users/<?php echo $AllUsers[$i]['id']; ?>"><i class="fa fa-edit"></i></a></td><?php } ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>
</section>