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
  <div class = header>
    <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = wrap>
    <div class = signup_form>
      <div class = form_header>
        <h1>Confirm</h1>
      </div>
      <div class =confirm>
        <p class =comment>
          内容を確認し、OKボタンを押してください。
        </p>
        <form action="itempost" method="post">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="item_name" value="<?php echo e($post_data->item_name); ?>">
          <input type="hidden" name="category_id" value="<?php echo e($post_data->category_id); ?>">
          <input type="hidden" name="price" value="<?php echo e($post_data->price); ?>">
          <input type="hidden" name="item_other" value="<?php echo e($post_data->item_other); ?>">
          <input type="hidden" name="img_url" value="<?php echo e($img_url); ?>">
          <?php if(!empty($img_url)): ?>
          <div class= item_edit_confirm_img>
            <img class= item_edit_confirm_img src="storage/items/tmp/<?php echo e($img_url); ?>" alt="">
          </div>
          <?php else: ?>
          <?php endif; ?>

          <div class= item_edit_confirm_info>
           <table>
             <tr>
              <th><h2>品名</h2></th>
                <td><p><?php echo e($post_data->item_name); ?></p></td>
             </tr>
             <tr>
              <th><h2>カテゴリ</h2></th>
                <td><p><?php echo e($item_cate->name); ?></p></td>
              </tr>
              <tr>
                <th><h2>価格</h2></th>
                  <td><p>¥<?php echo e($post_data->price); ?></p></td>
              </tr>
              <tr>
                <th style="border-bottom: none;"><h2>その他情報</h2></th>
                <td style="border-bottom: none;"><p><?php echo e($post_data->item_other); ?></p></td>
              </tr>
                <?php echo e($item_cate->pic); ?>

            </table>
          </div>
              <input type="submit" name="review_complete_btn" id ="signup_btn" value="OK" >
              <div class="back_area">
                <button type="button" class="back_btn" onClick="history.back()">修正する</button>
              </div>

        </form>
      </div>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/r_confirm.blade.php ENDPATH**/ ?>