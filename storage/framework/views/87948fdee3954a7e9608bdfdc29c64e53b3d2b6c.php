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
    <?php echo $__env->make('header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <div class = wrap>
    <div class = signup_form>
      <div class = form_header>
        <h1>Signup</h1>
      </div>
    <form id="signupForm" name="signupForm" action="confirm" method="POST">
      <?php echo csrf_field(); ?>
      <p>必要事項を記入の上、送信してください。</p>
      <label for="">Name</label>
        <?php if($errors->has('name')): ?>
          <span><?php echo e($errors->first('name')); ?></span>
        <?php endif; ?>
        <input type="text" id="name" name="name" placeholder="" value="<?php echo e(old('name')); ?>">
      <label for="">Email</label>
        <?php if($errors->has('email')): ?>
          <span><?php echo e($errors->first('email')); ?></span>
        <?php endif; ?>
        <input type="text" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="">
      <label for="password">Password</label>
        <?php if($errors->has('password')): ?>
            <span><?php echo e($errors->first('password')); ?></span>
        <?php endif; ?>
        <input type="password" id="password" name="password" placeholder="" value="<?php echo e(old('password')); ?>">
      <label for="password_confirm">Password(再入力)</label>
        <?php if($errors->has('password_confirm')): ?>
          <span><?php echo e($errors->first('password_confirm')); ?></span>
        <?php endif; ?>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" value="<?php echo e(old('password_confirm')); ?>">
      <label for="pet">Pet dog</label>
      <select name="pet_id">
        <?php $__currentLoopData = $dogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($dog->id); ?>" <?php if(old('pet_id') == $dog->id): ?> selected <?php endif; ?>><?php echo e($dog->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
        <input type="submit" id="signup_btn" name="login" value="submit">
      </form>
  </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pet\resources\views/signup.blade.php ENDPATH**/ ?>