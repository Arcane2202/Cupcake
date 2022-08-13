<div id="status">

                        <div style="width: 100%;">
                           <?php

                                $img = "";
                                if($posterUs['gender']=="Male") {
                                    $img .= "images/manDummy.jpg";
                                } elseif($posterUs['gender']=="Female") {
                                    $img .= "images/girlDummy.jpg";
                                }
                            ?>
                            <div class="texthover" id="NameHeader" style="color: var(--col9);">
                                <a href="" style="color: antiquewhite; text-decoration:none">
                                    <img src="<?php echo $img?>" style="border-radius:50px; width:10%;">
                                </a>
                                <a href="" style="margin-left:2%; color: antiquewhite; text-decoration:none;">
                                    <span class="texthover" ><?php echo $posterUs['firstName']." ".$posterUs['lastName'] ?></span> 
                                </a>
                                <span class="smallestText" id="time" style="margin-top:5%; color: var(--col8); float:right"><?php echo $val['date'] ?></span>
                            </div>
                            <div style="margin-left: 2%;">
                                <?php echo $val['post'] ?>

                                <br> <br>
                                <div id="reactSec">
                                    <div id="flex" style="padding-left: 18%;">

                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-comment fa-2x" aria-hidden="true"></i>

                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-share fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>