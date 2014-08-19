<!-- Sidebar user panel -->
                    <div class="user-panel">
                        
                        <div class="pull-left info">
                            <p>Hello, <?php echo $this->tank_auth->get_username(); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form 
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo site_url('admin4739');?>">
                                <i class="ion ion-android-book"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="ion ion-ios7-folder"></i>
                                <span>Company</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('admin4739/service');?>"><i class="ion ion-wrench"></i> Services</a></li>
                                <li><a href="<?php echo site_url('admin4739/team');?>"><i class="ion ion-android-friends"></i> Teams</a></li>
                                <li><a href="<?php echo site_url('admin4739/portofolio');?>"><i class="ion ion-images"></i> Portofolio</a></li>
                                <li><a href="<?php echo site_url('admin4739/client');?>"><i class="ion ion-person-stalker"></i> Clients</a></li>
                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="ion ion-ios7-folder"></i>
                                <span>Blog</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('admin4739/article');?>"><i class="ion ion-clipboard"></i> Article</a></li>
                                <li><a href="<?php echo site_url('admin4739/category');?>"><i class="ion ion-android-note"></i> Category</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="ion ion-ios7-folder"></i>
                                <span>Widget</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo site_url('admin4739/slider');?>"><i class="ion ion-android-image"></i> Slider Image</a></li>
                                <li><a href="<?php echo site_url('admin4739/socmed');?>"><i class="ion ion-social-twitter"></i> Social Media</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('admin4739/contact');?>">
                                <i class="ion ion-chatbubble-working"></i>
                                <span>Contact</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        </li>
                    </ul>