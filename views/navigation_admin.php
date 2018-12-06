    <nav class="adm col-xs-10 col-xs-offset-0 col-sm-6 col-md-6">
    	<div id="nav-in_a">
            <ul>
                <a href="/admin" id="nav-glowna" class="<?php if(isset($this->NavBold) and $this->NavBold == 'index'){ echo "active"; } ?>"><li>Home</li></a>
                <a href="/admin/products" id="nav-products" class="<?php if(isset($this->NavBold) and $this->NavBold == 'products'){ echo "active"; } ?>"><li>Products</li></a>
                <a href="/admin/ingredients" id="nav-ingredients" class="<?php if(isset($this->NavBold) and $this->NavBold == 'ingredient'){ echo "active"; } ?>"><li>Ingredients</li></a>
                <a href="/admin/nutrients" id="nav-nutrients" class="<?php if(isset($this->NavBold) and $this->NavBold == 'nutrients'){ echo "active"; } ?>"><li>Nutrients</li></a>
                <a href="/admin/users" id="nav-users" class="<?php if(isset($this->NavBold) and $this->NavBold == 'users'){ echo "active"; } ?>"><li>Users</li></a>
            </ul>
        </div>
        <span class="adminHello">Hello <?php echo Session::get('user_name'); ?>,&nbsp;&nbsp;<a href="/login/logout">Log out</a></span>
    </nav>
    <div class="clearfix"></div>