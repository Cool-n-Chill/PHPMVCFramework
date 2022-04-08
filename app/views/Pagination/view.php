<div class="page-navigation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <?php if (($links['back'])): ?>
                        <li><a href="<?=$links['back']?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php endif; ?>
                    <?php if (($links['page2left'])): ?>
                        <li><a href="<?=$links['page2left']?>"><?=$currentPageNumber-2?></a></li>
                    <?php endif; ?>
                    <?php if (($links['page1left'])): ?>
                        <li><a href="<?=$links['page1left']?>"><?=$currentPageNumber-1?></a></li>
                    <?php endif; ?>
                    <li class="current-page"><a><?=$currentPageNumber?></a></li>
                    <?php if (($links['page1right'])): ?>
                        <li><a href="<?=$links['page1right']?>"><?=$currentPageNumber+1?></a></li>
                    <?php endif; ?>
                    <?php if (($links['page2right'])): ?>
                        <li><a href="<?=$links['page2right']?>"><?=$currentPageNumber+2?></a></li>
                    <?php endif; ?>
                    <?php if (($links['forward'])): ?>
                        <li><a href="<?=$links['forward']?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
