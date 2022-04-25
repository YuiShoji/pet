<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </head>
<body>
  <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class = main_wrap>
    <h1>Reviews</h1>
      <div class=search_area>
      </div>
      <div class = item_area>
      <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $pass='img/items/'.$item->id.'.jpg' ?>
        <div class=item>
          <div class=img_area>
            <form method="get" action="view">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
              <?php if(File::exists($pass)): ?>
                <input type="image" class="item_img" src="img/items/<?php echo e($item->id); ?>.jpg">
              <?php else: ?>
                <input type="image" class="item_img" src="img/items/0.jpg">
              <?php endif; ?>
            </form>
          </div>
          <div class=item_li><?php echo e($item->name); ?></div>
          <div class=item_li><?php echo e($item->c_name); ?></div>
          <div class=item_li><?php echo e($item->price); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php echo e($items->links()); ?>

    </div>
</body>
</html>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\pet\resources\views//main_owner.blade.php ENDPATH**/ ?>