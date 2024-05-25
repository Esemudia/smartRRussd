     <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="../assets/images/profile-image.jpg" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">
                       
                                <p><?php echo $_SESSION['alogin']?></p>

                         
                        </div>
                    </div>
                
                    <?php 
                    $page = explode("?",array_reverse(explode("/",$_SERVER['PHP_SELF']))[0])[0];
                    ?>
                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                    <li class="no-padding <?= $page == 'dashboard.php' ? 'active' : '' ?>"><a class="waves-effect waves-grey" href="dashboard.php"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                    <li class="no-padding <?= in_array($page,['adddstate.php', 'managestatee.php']) ? 'active' : '' ?>">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>State<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li class=" <?= $page == 'adddstate.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="adddstate.php">Add State</a></li>
                                <li class=" <?= $page == 'managestate.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="managestate.php">Manage State</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">place</i>Location<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="addlocation.php">Add Location</a></li>
                                <li><a href="manageLocation.php">Manage Location</a></li>
       
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">account_box</i>Employees<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="addemployee.php">Add Employe</a></li>
                                <li><a href="manageemployee.php">Manage Employee</a></li>
       
                            </ul>
                        </div>
                    </li>


                    <li class="no-padding <?= in_array($page,['addlanguagetype.php', 'managelanguagetype.php']) ? 'active' : '' ?>">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">code</i>Language Type<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li class=" <?= $page == 'addlanguagetype.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="addlanguagetype.php">Add Language Type</a></li>
                                <li class=" <?= $page == 'managelanguagetype.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="managelanguagetype.php">Manage Language Type</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding <?= in_array($page,['addservice.php', 'manageservice.php']) ? 'active' : '' ?>">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">service</i>Service Provider<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li class=" <?= $page == 'addservice.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="addservice.php">Add Service </a></li>
                                <li class=" <?= $page == 'manageservice.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="manageservice.php">Manage Service </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="no-padding <?= in_array($page,['addquestion.php', 'managequestion.php']) ? 'active' : '' ?>">
                        <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">question</i>Question<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li class=" <?= $page == 'addquestion.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="addquestion.php">Add Question </a></li>
                                <li class=" <?= $page == 'managequestion.php' ? 'blue-grey-text text-darken-2' : '' ?>"><a href="managequestion.php">Manage Question </a></li>
                            </ul>
                        </div>
                    </li>
                    
  <li class="no-padding"><a class="waves-effect waves-grey" href="changepassword.php"><i class="material-icons">settings_input_svideo</i>Chnage Password</a></li>

                        <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Log Out</a>
                            </li>  
                 

                 
              
                </ul>
                   <div class="footer">
                    <p class="copyright"><a target="__blank" href="">SMARTRR </a>©</p>
                
                </div>
                </div>
            </aside>
            <script>
                $(function(){
                   
                    var page = '<?= $page ?>';
                    if($('.sidebar-menu a[href="'+page+'"]').length > 0){
                        if($('.sidebar-menu a[href="'+page+'"]').closest('.collapsible-body').siblings('.collapsible-header').length > 0){
                            $('.sidebar-menu a[href="'+page+'"]').closest('.collapsible-body').siblings('.collapsible-header').trigger('click')
                        }

                    }
                })
            </script>