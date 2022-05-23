<nav class="st-menu st-effect-1" id="menu-1">
    <div class="doctor-profile">
        <div class="doctor-image">
            <img src="<?= $doctor['icon'] ?>" style="width: 200px;height: 200px;" class="img-fluid">
        </div>
        <div class="doctor-info">
            <div id="rateYoPPP"></div>
            <p class="doctor-designation" style="padding: 5px 0px 0px 5px;"><?= $doctor['name'] ?></p>
        </div>
    </div>
    <div class="doctor-details">
        <ul>
            <li class="clearfix">
                <strong class="float-left">Phone : </strong><span class="float-left"><?= $doctor['phone'] ?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left">Email : </strong><span class="float-left"><?= $doctor['email'] ?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left">Address : </strong><span class="float-left"><?= $doctor['address'] ?></span>
            </li>
            <li class="clearfix">
                <strong class="float-left">Degrees : </strong><span class="float-left">Doctor</span>
            </li>
        </ul>
        <div class="doctor-description">
            <h5>Profile</h5>
            <p>
                <?= $doctor['profile'] ?> </p>
        </div>
    </div>

    <div class="doctor-social">
        <ul class="social-media social-media--style-1-v4">
            <?php if ($doctor['fb_link'] != '') : ?>
                <li>

                    <a href="<?= '//'.$doctor['fb_link'] ?>" target="_blank">
                        <i class="ion ion-social-facebook"></i>
                    </a>

                </li>
            <?php endif; ?>
            <?php if ($doctor['twitter_link'] != '') : ?>
            <li>
                <a href="<?= '//'.$doctor['twitter_link'] ?>" target="_blank">
                    <i class="ion ion-social-twitter"></i>
                </a>
            </li>
            <?php endif; ?>
            <?php if ($doctor['googleplus_link'] != '') : ?>
            <li>
                <a href="<?= '//'.$doctor['googleplus_link'] ?>" target="_blank">
                    <i class="ion ion-social-googleplus"></i>
                </a>
            </li>
            <?php endif; ?>
            <?php if ($doctor['Linkedin_link'] != '') : ?>
            <li>
                <a href="<?= '//'.$doctor['Linkedin_link'] ?>" target="_blank">
                    <i class="ion ion-social-linkedin"></i>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>