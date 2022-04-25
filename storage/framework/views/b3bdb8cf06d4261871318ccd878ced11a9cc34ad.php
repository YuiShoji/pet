<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="css/bootstrap.css">
 <link rel="stylesheet" type="text/css" href="css/style.css">
 <script src="js/index.js"></script>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </head>
<body>
  <div class = header>
    <?php echo $__env->make('header1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = wrap>
    <div class = view_area>
      <div class = form_header>
        <h1>ユーザ一覧</h1>
      </div>
      <div class=user_wrap>
          <div class=user_search_area>
            <h4>Search</h4>
            <table class=user_search>
              <form id="signupForm" name="signupForm" action="users" method="get">
                <tr>
                  <th>ペットの種類で絞込</th>
                </tr>
                <th><select name="search_pet_id">
                  <option value=”0” <?php if($pet_id == 0): ?> selected <?php endif; ?>>すべて表示</option>
                    <?php $__currentLoopData = $dogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($dog->id); ?>" <?php if($pet_id ==  $dog->id): ?> selected <?php endif; ?>><?php echo e($dog->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select></th>
                <td><input type="submit" id="search_btn" class="fas" value="&#xf002;"></td>
              </form>
            </table>
            <div class="message">
                <?php echo e($count); ?>件
            </div>
          </div>


        <div class=user_list>
          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class=user>
            <div class=user_list_img>
              <form method="get" action="user">
                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                <?php $pass='storage/users/'.$user->id.'.jpg' ?>
                <?php if(File::exists($pass)): ?>
                  <input type="image" class="view_icon" src="<?php echo e($pass); ?>">
                <?php else: ?>
                  <input type="image" class="view_icon" src="storage/users/0.jpg">
                <?php endif; ?>
              </form>
            </div>
            <div class = users_list_info>
              <table class = users_list_table>
              <tr>
              <th ><p>NAME</p></th>
                <td style="border-bottom: none;"><div class = users_list_yoso><?php echo e($user->name); ?></div></td>
              </tr>
              <tr>
              <th><p>PET</p></th>
                <td><div class = users_list_yoso><?php echo e($user->d_name); ?></div></td>
              </tr>
                <?php if(Auth::user()->owner == '1'): ?>
                  <tr>
                  <th><p>MAIL</p></th>
                    <td><div class = users_list_yoso><?php echo e($user->email); ?></div></td>
                  </tr>
                  <tr>
                    <th><form action="user_delete" method="post" onSubmit="return submitCheck()">
                      <?php echo csrf_field(); ?>
                      <input type="submit" name="user_delete_btn" id ="item_delete_btn" value="削除" >
                      <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                    </form></th>
                    <td></td>
                  </tr>
                <?php else: ?>
                <?php endif; ?>
              </table>
            </div>
          </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <br>
        <?php echo e($users->links()); ?>

        <div class="back_area">
          <button type="button" class="back_btn" onClick="history.back()">もどる</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/users.blade.php ENDPATH**/ ?>