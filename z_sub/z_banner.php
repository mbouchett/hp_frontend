<link rel="stylesheet" href="../css/banner.css" type="text/css" />
        <div id="banner">
            <div class="infoline">
                <div><a href="../index.php"><img src="../images/compass.png" alt="Homeport Logo" title="Back to Homepage"></a></div>
                <a class="linkbtn" href="https://goo.gl/maps/Qn1piCjdYL82">
                    <i class="iconsize fas fa-map-marker-alt"></i><div class="address icontext"><span class="hiddenformobile">Find Us!</span></div>
                </a>
                <a class="linkbtn" href="tel:802-863-4644">
                    <i class="iconsize fas fa-phone"></i><div class="icontext"><span class="hiddenformobile">802-863-4644</span></div>
                </a>
                <a class="linkbtn" onclick="openNav()"><i class="iconsize fas fa-bars"></i><div class="icontext"><span class="hiddenformobile">Departments</span></div>
                </a>
                <div class="hours">
                    Starting 05/18/20<br>

                    Hours: Sun to Thur 10a-6p<br>Fri &amp; Sat 10a-8p
                </div>
            </div>
            <div class="menu">
                <div class="hiddenformobile">
                    <a class="menubtn" href="../registries/index.php"><i class="fas fa-gift"></i>&nbsp;Registries</a>
                    <?php if($loggedIn) { ?>
                    <a class="menubtn" href="../favorites.php"><i class="fas fa-heart"></i>&nbsp;My Favorites</a>
                    <?php } ?>
                    <a class="menubtn" href="../giftCard.php"><i class="fas fa-credit-card"></i>&nbsp;Gift Cards</a>
                    <a class="menubtn" href="../storeInfo.php"><i class="fas fa-info-circle"></i>&nbsp;Store info</a>
                </div>
                <div class="accountcontainer">
                    <!--this will need to change based on user sign in-->
                    <?php if(!$loggedIn) { ?>
                        <a class="accountbtn" href="../account/signIn.php"><i class="fas fa-user"></i>&nbsp;<span class="hiddenformobile">Sign In</span></a>
                    <?php }else { ?>
                        <a style="color: rgba(190,0,1,1.00)" class="accountbtn" href="../account"><i class="fas fa-user"></i>&nbsp;<span class="hiddenformobile"><?= $_COOKIE['c_name'] ?></span></a>
                    <?php } ?>
                    <!--itemsindicater should only appear if there are item in the cart and should show the count cart-->
                    <?php if($cartCount > 0) { ?>
                    	<a class="accountbtn" style="color: rgba(190,0,1,1.00)" href="../cart/"><i class="fas fa-shopping-cart"></i><span class="itemsindicator"><?= $cartTotItems ?></span></a>
					<?php }else { ?>
						<a class="accountbtn" href="../cart/"><i class="fas fa-shopping-cart"></i></a>
					<?php }?>
                </div>
                <div class="searchcontainer">
                    <form name="search" action="../search.php" method="post">
                    <input class="searchfield" name="key" placeholder="Search" />
                    <a class="searchbtn" onClick="document.search.submit()"><i class="fas fa-search"></i></a>	
                    </form>
                </div>
            </div>
        </div>