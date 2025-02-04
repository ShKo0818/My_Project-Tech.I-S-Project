

<?php $__env->startSection('title', '注文確認'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>注文確認</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <p>ご注文内容を確認の上、「注文します」ボタンを押して、注文を完了してください。</p>

    <h4>お名前: <?php echo e($name); ?></h4>
    <h4>ご住所: <?php echo e($address); ?></h4>
    <h4>電話番号: <?php echo e($phone); ?></h4>

    <form action="<?php echo e(route('cart.placeOrder')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <button type="submit" class="btn btn-success">注文します</button>
        <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-danger">戻る</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/cart/confirm.blade.php ENDPATH**/ ?>