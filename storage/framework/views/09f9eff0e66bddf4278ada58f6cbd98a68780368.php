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
 </head>
<body>
  <div class = header>
    <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = wrap>
    <div class = view_area>
      <div class = form_header>
        <h1>レビュー編集</h1>
      </div>
      <div class=review_post_wrap>
        <div class=review>
          <div class=item_info_review>
            <h4>アイテム情報</h4>
              <div class=item_info>No.<?php echo e($itemView->id); ?></div>
              <div class=item_info>品名：<?php echo e($itemView->name); ?></div>
              <div class=item_info>価格：¥<?php echo e($itemView->price); ?>(税込)</div>
              <div class=item_info><?php echo nl2br(e($itemView->other)); ?></div>
          </div>
          <form id="reviewForm" name="reviewForm" action="re_confirm" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="review_id" value="<?php echo e($review->id); ?>">
            <input type="hidden" name="item_id" value="<?php echo e($itemView->id); ?>">
              <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span><?php echo e($error); ?></span><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <h4>評価</h4>
              <div class="rate-form">
                  <input id="star5" type="radio" name="rate" value="5" <?php echo e(old('rate',$review->star) == '5' ? 'checked' : ''); ?>>
                  <label for="star5">★</label>
                  <input id="star4" type="radio" name="rate" value="4" <?php echo e(old('rate',$review->star) == '4' ? 'checked' : ''); ?>>
                  <label for="star4">★</label>
                  <input id="star3" type="radio" name="rate" value="3" <?php echo e(old('rate',$review->star) == '3' ? 'checked' : ''); ?>>
                  <label for="star3">★</label>
                  <input id="star2" type="radio" name="rate" value="2" <?php echo e(old('rate',$review->star) == '2' ? 'checked' : ''); ?>>
                  <label for="star2">★</label>
                  <input id="star1" type="radio" name="rate" value="1" <?php echo e(old('rate',$review->star) == '1' ? 'checked' : ''); ?>>
                  <label for="star1">★</label>
                </div>
                <h4>レビュー</h4>
                 <textarea id='review' type="text" name="review"><?php echo e(old('review',$review->review)); ?></textarea>
              <input type="submit" id="review_sub" name="review_edit" value="submit">
          </form>
        </div>
      </div>
      <div class="back_area">
        <button type="button" class="back_btn" onClick="history.back()">もどる</button>
      </div>

    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/review_edit.blade.php ENDPATH**/ ?>