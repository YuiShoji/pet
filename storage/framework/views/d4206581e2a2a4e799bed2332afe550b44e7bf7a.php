<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="js/index.js"></script>
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
        <h1>アイテム登録</h1>
      </div>
      <div class = item_edit_view>
        <form action="r_confirm" method="POST" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>
          <div class= item_edit_img_area>
            <div class=item_edit_img>
              <img id="preview" src="storage/users/0.jpg" class="itemedit_icon">
            </div>
            <label class =fileup>
              <input onchange="previewImage(this)" type="file" name="pic" class="img_form" >
              ファイルを選択
            </label>
          </div>

          <div class= item_edit_info_area>
            <table>
              <tr>
                <th><p>品名</p></th>
                  <td><input type="text" class='mypage_info' name="item_name" value="<?php echo e(old('item_name')); ?>"></td>
              </tr>
              <tr>
                <th><p>カテゴリ</p></th>
                <td><select name="category_id" class=item_edit_cate>
                  <?php $__currentLoopData = $itemcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($itemcategory->id); ?>"><?php echo e($itemcategory->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></td>
              </tr>
              <tr>
                <th><p>価格(税込)</p></th>
                <td><input type="text" class='mypage_info' name="price" value="<?php echo e(old('price')); ?>"></td>
              </tr>
              <tr>
                <th><p>その他情報</p></th>
                <td><textarea id='item_other' type="text" name="item_other"><?php echo e(old('item_other')); ?></textarea></td>
              </tr>
              <tr>
                <th></th>
                  <td><input type="submit" id="itemedit_btn" value="内容確認へ" ></td>
              </tr>
            </table>
            <?php if(!empty($errors)): ?>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span><?php echo e($error); ?><br></span>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php endif; ?>

          </div>
        </form>
      </div>
      <br><br><br>
      <div class="back_area">
        <button type="button" class="back_btn" onClick="history.back()">戻る</button>
      </div>
    </div>
  </div>
</body>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/item_register.blade.php ENDPATH**/ ?>