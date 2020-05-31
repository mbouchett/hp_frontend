<link rel="stylesheet" href="../css/footer.css" type="text/css" />
    <div id="footer">
            <div class="footercontainer">
                <div class="linkcontainer">
                    <div class="linkheader">Get In Touch</div>
                    <a href="../contact.php"><i class="fas fa-envelope"></i>Contact Us</a>
                    <a href="https://www.facebook.com/homeportonline/"><i class="fab fa-facebook"></i>Visit us on Facebook</a>
                    <a href="https://www.instagram.com/homeportbtv/"><i class="fab fa-instagram"></i>Check out our Instagram</a>
                    <a href="https://twitter.com/homeportonline"><i class="fab fa-twitter"></i>Tweet us your thoughts!</a>
                    <a href="http://www.yelp.com/biz/homeport-burlington"><i class="fab fa-yelp"></i>Review us on Yelp</a>
                </div>
                <div class="linkcontainer">
                    <div class="linkheader">Site Navigation</div>
                    <a href="../index.php"><i class="fas fa-home"></i>Home</a>
                    <a href="../favorites.php"><i class="fas fa-heart"></i>My Favorites</a>
                    <a href="../registries/regSearch.php"><i class="fas fa-search"></i>Find a Registry</a>
                    <a href="../registries/createReg.php"><i class="fas fa-gift"></i>Create or Manage Registry</a>
                    <a href="../departments.php"><i class="fas fa-store"></i>Shop Departments</a>
                    <a href="#banner"><i class="fas fa-arrow-up"></i>Back to top</a>
                </div>
                <div class="linkcontainer">
                    <div class="linkheader">Help</div>
                    <?php if(!$loggedIn) { ?>
                        <a href="../account/signIn.php"><i class="fas fa-user"></i>My Account</a>
                    <?php }else { ?>
                        <a href="../account"><i class="fas fa-user"></i>My Account</a>
                    <?php } ?>
                    <a href="../giftCard.php"><i class="fas fa-credit-card"></i>Check Gift Card Balance</a>
                    <a href=""><i class="fas fa-plane"></i>Shipping Information</a>
                    <a href=""><i class="fas fa-info-circle"></i>Store Pickup Information</a>
                    <a href="../storeInfo.php"><i class="fas fa-question"></i>FAQ</a>
                </div>
            </div>
            <div class="copyinfo">
                &copy; 2019 Homeport, LTD. the Compass Design is a trademark of Homeport, LTD. All rights reserved.
            </div>
        </div>