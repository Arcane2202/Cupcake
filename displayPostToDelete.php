<div id="status">

    <div style="width: 100%;">

        <div style="margin-left: 2%; margin-top:5%">
            <?php echo htmlspecialchars($val['post']) ?>
            <br> <br>
            <?php 
                    if(file_exists($val['image'])) {
                        $image = $media->preview($val['image'],'dp');
                        echo "<img src='$image' style='width:54vw; margin-bottom:15px'/>";
                    }
            ?>
        </div>
    </div>
</div>