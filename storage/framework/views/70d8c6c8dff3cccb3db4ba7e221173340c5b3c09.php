<?php ini_set("memory_limit", "3072M");?>
<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="css/style.css">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
 <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
 </head>
<body>
  <div class = header>
    <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = wrap>
    <div class = view_area>
      <div class = form_header>
        <h1>アイテム詳細</h1>
      </div>
        <div class = view_item>
            <?php $pass='storage/items/'.$itemView->id.'.jpg' ?>
            <div class=view_img_area>
              <?php if(File::exists($pass)): ?>
              <a href="<?php echo e($pass); ?>" data-lightbox="group"><img class="item_img" src="<?php echo e($pass); ?>"></a>
              <?php else: ?>
                <img class="item_img" src="img/items/0.jpg">
              <?php endif; ?>
            </div>
          <div class=item_info>
            <table class=item_view_table>
              <tr>
                <th><p>No.</p></th>
                  <td><div class=item_li_view><?php echo e($itemView->id); ?></div></td>
              </tr>
              <tr>
                <th><p>品名</p></th>
                  <td><div class=item_li_view><?php echo e($itemView->name); ?></div></td>
              </tr>
              <tr>
                <th><p>価格</p></th>
                  <td><div class=item_li_view>¥<?php echo e($itemView->price); ?>(税込)</div></td>
              </tr>
              <tr>
                <?php $__currentLoopData = $c_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <th><p>カテゴリ</p></th>
                    <td><div class=item_li_view><?php echo e($c_name->c_name); ?></div></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tr>
             <tr>
               <th>その他の情報</th>
                 <td><div class=item_li_view_other><?php echo nl2br(e($itemView->other)); ?></div></td>
             </tr>
             </table>
              <?php if(!$alreadylike->isEmpty()): ?>
                <!--いいね済の場合ぬりつぶし-->
                <div class=likes_area>
                    <a class="toggle_wish" item_id="<?php echo e($itemView->id); ?>" like_item="1">
                       <i class="fas fa-heart" style="color:red;">
                         <div id="like_counter"><?php echo e($itemlikes->likes_count); ?></div>
                      </i>
                    </a>
                </div>
                <?php else: ?>
                <!--いいね済の場合ぬりつぶしじゃない-->
                <div class=likes_area>
                    <a class="toggle_wish " item_id="<?php echo e($itemView->id); ?>" like_item="0">
                      <i class="far fa-heart">
                        <div id="like_counter"><?php echo e($itemlikes->likes_count); ?></div>
                      </i>
                    </a>
                </div>
                <?php endif; ?>
          </div>
      </div>
      <hr>
      <div class=review_area>
        <h1>Review</h1>
        <div class=reviewcount><?php echo e($count); ?>件</div>
          <form method="get" action="review" class=reviewPost>
            <input type="submit" class="review_post_btn" value=レビューを投稿する>
            <input type="hidden" name="item_id" value="<?php echo e($itemView->id); ?>">
            <input type="hidden" name="c_name" value="<?php echo e($c_name); ?>">
          </form>
      </div>
      <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class=review_view>
          <div class=user_area>
            <form method="get" action="user">
              <input type="hidden" name="id" value="<?php echo e($review->user_id); ?>">
              <?php $pass='storage/users/'.$review->user_id.'.jpg' ?>
              <?php if(File::exists($pass)): ?>
                <input type="image" class="view_icon" src="<?php echo e($pass); ?>">
              <?php else: ?>
                <input type="image" class="view_icon" src="storage/users/0.jpg">
              <?php endif; ?>
            </form>
              <?php echo e($review->name); ?>

              <br>
              Pet:<?php echo e($review->dog_name); ?>

          </div>
          <div class= user_review_area>
            <?php if($review->star == 1): ?>
            <div class=item_li>
              <i class=" fa-solid fa-star"></i>
              <i class=" fa-solid fa-star far-white"></i>
              <i class=" fa-solid fa-star far-white"></i>
              <i class=" fa-solid fa-star far-white"></i>
              <i class=" fa-solid fa-star far-white"></i>
            </div>
              <?php elseif($review->star == 2): ?>
              <div class=item_li>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star far-white"></i>
                <i class=" fa-solid fa-star far-white"></i>
                <i class=" fa-solid fa-star far-white"></i>
              </div>
              <?php elseif($review->star == 3): ?>
              <div class=item_li>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star far-white"></i>
                <i class=" fa-solid fa-star far-white"></i>
              </div>
              <?php elseif($review->star == 4): ?>
              <div class=item_li>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star far-white"></i>
              </div>
              <?php elseif($review->star== 5): ?>
              <div class=item_li>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
                <i class=" fa-solid fa-star"></i>
              </div>
            <?php endif; ?>
            <div class=review_body>
              <?php echo nl2br(e($review->review)); ?>

            </div>

            <?php if(Auth::id() == $review->user_id): ?>
            <form method="get" action="review_edit">
              <input type="hidden" name="review_id" value="<?php echo e($review->review_id); ?>">
              <input type="hidden" name="item_id" value="<?php echo e($itemView->id); ?>">
              <input type="submit" class="fa review_edit" value=&#xf044;>
            </form>
            <?php else: ?>
            <?php endif; ?>
          </div>
      </div>
      <hr class = reviewhr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="back_area">
        <button type="button" class="back_btn_review" onClick="history.back()">もどる</button>
      </div>
  </div>
</body>
</html>

<script src="js/index.js"></script>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/view.blade.php ENDPATH**/ ?>