<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="js/index.js"></script>
</head>
<body>
  <div class = header>
    <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = top_gazo_area>
    <img class="top_img" src="/img/maindog.jpg">
  </div>
  <div class = owner_main_wrap>
    <h5>Items</h5>
    <div class=search_area>
      <div class="btn01">
        <a href="/item_register">ITEM登録→</a>
      </div>
      <table>
        <form id="item_search" name="signupForm" action="owner_main" method="get">
          <tr>
            <th>カテゴリで絞込</th>
          </tr>
          <tr>
            <th><select name="search_category_id">
              <option value=”0” <?php if($cate_id == 0): ?> selected <?php endif; ?>>All</option>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($categories->id); ?>" <?php if($cate_id ==  $categories->id): ?> selected <?php endif; ?>><?php echo e($categories->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select></th>
            <td><input type="submit" id="search_btn" class="fas" value="&#xf002;"></td>
          </tr>
        </form>
      </table>
      <div class="message">
          <?php print_r($count); ?>件
      </div>
    </div>
    <div class = item_area>
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $pass='storage/items/'.$item->id.'.jpg' ?>
      <div class=item>
        <div class=img_area>
          <form method="get" action="item_edit">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
            <?php if(File::exists($pass)): ?>
            <input type="image" class="item_img" src="<?php echo e($pass); ?>">
            <?php else: ?>
            <input type="image" class="item_img" src="img/items/0.jpg">
            <?php endif; ?>
          </form>
        </div>
        <div class=item_li><?php echo e($item->name); ?></div>

        <div class=likeandreview>
          <div class=item_rl>
            <i class="fa-solid fa-comment" style="color:skyblue;"></i>
            <?php if(empty($item->r_count)): ?>
            0
            <?php else: ?>
            <?php echo e($item->r_count); ?>

            <?php endif; ?>
          </div>

          <div class=item_l>
            <i class="fas fa-heart" style="color:hotpink;">
            </i>
            <?php if(empty($item->l_count)): ?>
            0
            <?php else: ?>
            <?php echo e($item->l_count); ?>

            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e($items->links()); ?>

  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/owner_main.blade.php ENDPATH**/ ?>